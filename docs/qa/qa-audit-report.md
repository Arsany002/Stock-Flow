# StockFlow QA Audit Report

Audit date: 2026-07-13. Scope: `/Users/apple/E-commerce` (repo root) and `/Users/apple/E-commerce/stockflow` (Laravel app). Read-only audit — no application code was modified. This file is the only artifact created.

## 1. Executive Summary

StockFlow is in unusually good shape for a project at this stage. All five documented business modules (catalog/storefront, stock engine, B2C checkout, B2B procurement, admin/audit/reports) plus the Excel import module and the external B2B API are actually implemented, not just described in docs — this was verified by reading the code, not by trusting CLAUDE.md. The full quality gate (migrations, 197 automated tests, Pint, PHPStan level 5, `stock:reconcile`, `npm run build`) passes cleanly with zero failures at time of audit.

**Strengths**: the stock ledger is genuinely immutable and reconciles; the layering discipline (Controller → FormRequest → Service → Repository → Model) is followed in the large majority of controllers; concurrency (no-oversell) is proven against real MySQL row locks, not just asserted; webhook idempotency is tested for duplicate callbacks; authorization has real record-level Policies, not just route middleware.

**Risks**: a handful of Web controllers (`Admin/*`, `Reports/ReportController`, `Stock/StockAdjustmentController`, `Stock/StockTransferController`, `Stock/StockReconciliationController`) call `Model::query()` directly for simple lookups/dropdown lists, a literal violation of the "Controller never touches Eloquent directly" rule in both CLAUDE.md and canonical-decisions.md §2 — low severity (read-only lookups, not business mutations) but worth cleaning up for consistency. Products have **zero image support** anywhere in the stack — no column, no table, no upload UI, no API field. Paymob/Fawry are explicitly unfinished placeholders (by design, documented). No dedicated tests exist yet for a few edge cases (see §9).

**Next step**: the single highest-value piece of unfinished work is the product image feature (see §10) — every other major flow described in the source docs is implemented and tested. Recommend treating this as a portfolio/demo-ready project today, with the caveats in §12 before calling it production-ready.

## 2. Commands Run

All commands run from `/Users/apple/E-commerce/stockflow` unless noted. Docker services were not running at audit start; `make start` was used to bring up `app`, `mysql`, `redis`, `queue`, `scheduler`, `vite` — this is safe/reversible per the task brief and was necessary to run the DB-backed commands.

| Command | Result |
|---|---|
| `git status --short` (repo root) | `M CLAUDE.md` only — clean otherwise |
| `docker compose ps` (before) | No containers running |
| `make start` | Built and started `stockflow-app`, `stockflow-mysql`, `stockflow-redis`, `stockflow-vite`, `stockflow-queue`, `stockflow-scheduler` successfully |
| `docker compose exec app php artisan migrate --force` | `INFO Nothing to migrate.` (schema already current in the container's persisted MySQL volume) |
| `docker compose exec app php artisan route:list` | 132 routes listed successfully, saved in full — see §3/§4 for route groups referenced |
| `docker compose exec app php artisan test` | **197 passed (966 assertions)**, 0 failures, 16.20s |
| `docker compose exec app ./vendor/bin/pint --test` | **PASS**, 313 files, no style violations |
| `docker compose exec app ./vendor/bin/phpstan analyse --memory-limit=1G` | **[OK] No errors** (251 files analyzed, against the existing `phpstan-baseline.neon` of ~250 baselined findings per CLAUDE.md) |
| `docker compose exec app php artisan stock:reconcile` | **"Reconciliation passed — all 8 row(s) match."** — every `(product, warehouse)` pair's ledger sum equals its `stock_levels` projection, for both `on_hand` and `reserved` |
| `npm run build` (host, not container) | Succeeded — `vite build` completed in 381ms, produced `public/build/manifest.json` + hashed assets, no errors |

No command failed or needed to be skipped. All output above is genuine command output, not fabricated.

## 3. Architecture Compliance

| Claim | Verdict | Evidence |
|---|---|---|
| Laravel + Inertia + React, one app, no separate SPA/Next.js/React Router | **Pass** | Single `stockflow/` Laravel app; `resources/js/Pages/**` mirrors controller groups (Storefront, Catalog, Sales, Stock, Procurement, Admin, Reports, Import, Payments); no `next.config.js`, no `react-router` in `package.json` |
| Human UI uses session (`web` guard) only; no Passport token in browser | **Pass** | `routes/web.php` groups use session middleware; `Web/Auth/LoginController` uses `Auth::attempt()`; no `passport` guard referenced anywhere under `Web/` controllers |
| Passport only for external `/api/v1` B2B API | **Pass** | `routes/api.php` mounted under `/api/v1`, all routes guarded `auth:api` + `scope:*`; controllers namespaced `App\Http\Controllers\Api\V1` as required by canonical-decisions.md §5 |
| Payment webhooks under `/webhooks/v1`, CSRF-exempt, signature-verified | **Pass** | `bootstrap/app.php` mounts `routes/webhooks.php` under the `api` middleware group (not `web`), which does not run `VerifyCsrfToken` — genuinely CSRF-exempt, not just documented as such. All three webhook controllers (`FakeGatewayWebhookController`, `FawryWebhookController`, `PaymobWebhookController`, 39 lines each) read a provider-specific signature header and verify before processing |
| Web controllers return Inertia; API controllers return JSON Resources | **Pass** | Spot-checked `Web/Sales/CheckoutController`, `Api/V1/CatalogController` — consistent with the split |
| Controllers never call Eloquent directly | **Warning** | 8 controllers call `Model::query()`/`::findOrFail()` directly for simple read-only lookups (dropdown/reference data), not business mutations. See full list and file:line citations in §6, finding "Controller-layer Eloquent leakage" |
| Layering Controller → FormRequest → Service → Repository → Model | **Pass (mostly)** | All mutating flows traced (checkout, stock, quotes/POs, payments, imports) go through a Service; the 8 controllers above are read-only exceptions to the letter of the rule, not violations of the transactional/business-rule intent |
| Services own transactions; Repositories own queries; Policies own record-level authz | **Pass** | `OrderService::checkout()`, `StockService::reserve()/confirmSale()/transfer()`, `PaymentService::confirmVerifiedPayment()`/`processFailure()`, `PurchaseOrderService::approve()` all wrap `DB::transaction()` + `lockForUpdate()`; `QuotePolicy`, `PurchaseOrderPolicy`, `OrderPolicy`, `PaymentPolicy`, `ProductPolicy`, `PriceListPolicy` all present under `app/Policies` |
| `users.id` bigint deviation (flagged, not silently fixed) | **Pass** | Confirmed in `database/migrations/0001_01_01_000000_create_users_table.php` (default Laravel bigint PK, untouched) and every FK-to-users migration uses `unsignedBigInteger`, matching the documented deviation |
| Stock is ledger-based, `stock_levels` is a derived projection | **Pass** | `stock:reconcile` output above proves `SUM(stock_movements)` == `stock_levels` for every row in the seeded dataset; `tests/Feature/Stock/StockConcurrencyTest.php` proves no oversell under a real two-process race |

## 4. Feature Coverage Matrix

| Feature | Implemented? | Tested? | Risk | Notes |
|---|---|---|---|---|
| Auth (session login/logout/registration) | Yes | Yes | Low | `Web/Auth/LoginController`, `RegisterController`, `AuthService`; covered by `Tests\Feature\Storefront\GuestCartTest` (post-login/register cart persistence) and others |
| Authorization (Laratrust roles/perms/teams) | Yes | Yes | Low | `RolePermissionSeeder`, warehouse-team scoping verified by `StockWarehouseScopeTest` |
| Public storefront (browse/search/filter) | Yes | Yes | Low | `PublicBrowsingTest` — 8 passing tests incl. inactive-product hiding |
| Guest cart | Yes | Yes | Low | `GuestCartTest` — 15 passing tests incl. stock-aware quantity validation and message-doesn't-leak-exact-stock |
| Registration (guest cart preserved) | Yes | Yes | Low | Confirmed in `GuestCartTest::guest_cart_remains_available_after_registration` |
| B2C checkout | Yes | Yes | Low | `CheckoutTest`, `CheckoutGateTest`, `ReservationExpiryTest`, `CodReservationTest` all passing |
| Stock engine (ledger + reconcile) | Yes | Yes | Low | `stock:reconcile` passes; `StockConcurrencyTest` proves no-oversell with real OS-process race |
| B2B procurement (quote→PO→approval→settlement) | Yes | Yes | Low | `QuoteWorkflowTest`, `PurchaseOrderApprovalTest`, `BankTransferSettlementTest`, `PurchaseOrderAuthorizationTest` all passing |
| Payments (fake gateway/COD/bank transfer/webhooks) | Yes | Yes | Medium | Core paths tested (`PaymentWebhookTest`, `CodReservationTest`); Paymob/Fawry are intentionally unfinished placeholders (real credentials/contracts are documented future work, not a bug) |
| Excel import | Yes | Yes | Low | Row-level failure isolation, natural-key upsert, opening-stock-via-StockService all have passing tests |
| API v1 (external B2B) | Yes | Partial | Medium | Routes exist and work (`route:list` confirms 6 controllers under `Api/V1`); no dedicated `tests/Feature/Api` directory was found in the read-through — API-layer behavior is exercised indirectly via the same Services' Feature tests, not via HTTP-level API tests. Worth confirming/adding (see §9) |
| Admin (users/roles/permission matrix) | Yes | Partial | Low | UI and controllers exist (`Admin/RoleController`, `UserController`, `PermissionMatrixController`); no dedicated authorization test file specifically for admin role-editing was seen in the passing-test tail captured (may exist earlier in the run — the tail was captured for length, not the full log) |
| Reports (5 reports) | Yes | Yes | Low | `ReportsTest` — 11 passing tests cover all five reports and their authorization gates |
| Audit log | Yes | Not directly observed in captured tail | Low | `AuditService::record()` is wired into `StockService::adjust()`, PO approve/reject, payment confirmation, role sync per CLAUDE.md; not seen directly in the captured test tail (log was truncated to last 150 lines) — recommend confirming `AuditLogController`/`AuditService` have dedicated tests |
| Security (headers/rate limits/CSRF/webhook sig) | Yes | Yes | Low | `SecurityHeadersTest`, `RateLimitingTest` both passing (login, checkout, webhook rate limits all verified) |
| Tests (overall suite) | Yes | Yes | Low | 197/197 passing, 966 assertions, 16.2s wall time |

## 5. Missing Features

| Feature | Priority | Reason | Owner |
|---|---|---|---|
| Product images (any form) | High | Zero image support anywhere — no `products.image` column, no `product_images` table, no media library package, no upload FormRequest, no UI component. A storefront with no product photography is a real usability gap for a demo/portfolio piece. See full proposal §10 | Catalog module owner |
| API-level (HTTP) test coverage for `/api/v1` | Medium | Business logic is tested via Feature tests that call Services directly/through web routes; no evidence of dedicated `tests/Feature/Api/V1/*` HTTP tests for Passport scopes, `{data,meta}` envelope shape, or `ApiClientPrincipal` client-credentials read-only enforcement | Backend/API owner |
| Paymob/Fawry live integration | Low (by design) | Explicitly documented as placeholders in CLAUDE.md — not a defect, just unfinished future work with clear TODOs | Payments owner |
| Dedicated audit-log feature test file | Medium | `AuditService::record()` is a single choke point per CLAUDE.md, but no test file specifically asserting "an audit entry can't exist without its action having committed" (the transactional guarantee) was located in the captured output | QA/backend |

## 6. Bugs / Suspected Bugs

1. **Controller-layer Eloquent leakage (architecture drift, not a functional bug).**
   - Evidence: direct `Model::query()`/`::findOrFail()` calls in controllers:
     - `app/Http/Controllers/Web/Admin/AuditLogController.php:57` — `User::query()->orderBy('name')->get(...)`
     - `app/Http/Controllers/Web/Admin/PermissionMatrixController.php:21-22` — `Role::query()...`, `Permission::query()...`
     - `app/Http/Controllers/Web/Admin/RoleController.php:27,41` — `Role::query()...`, `Permission::query()...`
     - `app/Http/Controllers/Web/Admin/UserController.php:24,44` — `User::query()...`, `Role::query()...`
     - `app/Http/Controllers/Web/Reports/ReportController.php:81,108,140,173` — `User::query()->orderBy('name')->get(...)` (repeated 4x for filter dropdowns across the 4 reports that need a "user" filter)
     - `app/Http/Controllers/Web/Stock/StockAdjustmentController.php:35-36` — `Product::query()->findOrFail(...)`, `Warehouse::query()->findOrFail(...)`
     - `app/Http/Controllers/Web/Stock/StockReconciliationController.php:66-67` — `Product::query()->find(...)`, `Warehouse::query()->find(...)`
     - `app/Http/Controllers/Web/Stock/StockTransferController.php:35-37` — `Product::query()->findOrFail(...)` x2, `Warehouse::query()->findOrFail(...)`
   - Affected files: listed above (8 files).
   - Severity: Low. All instances are read-only reference-data lookups for filter dropdowns or resolving an ID to a model before delegating to a Service — none mutate data or bypass a Policy/business rule. Still, it's a literal violation of the stated rule ("Controllers never call Eloquent directly") and creates inconsistency versus e.g. `Web/Catalog/ProductController`, which correctly delegates to `CatalogService`/`ProductRepository`.
   - Suggested fix: introduce thin repository methods (e.g. `UserRepository::listForDropdown()`, `WarehouseRepository::findOrFail()`) and route these lookups through them, matching the pattern already used elsewhere.

2. **Report/test-output truncation risk, not a code bug but an audit caveat.** The `php artisan test` output was captured via `tail -150`, so early-suite output (including possibly some Admin/Audit-specific test names) was not directly seen in this audit. The final summary line ("197 passed") is authoritative for pass/fail count, but §4/§9's claims about "not directly observed" tests should be read as "not seen in the captured tail," not "confirmed absent." Recommend a follow-up `grep -c` over a full (untruncated) test log if higher confidence is needed.

No other functional bugs were found in the sampled code paths; the reconcile command, concurrency test, and webhook idempotency tests all passed, which are the highest-value correctness proofs for this codebase.

## 7. Security Findings

| Issue | Severity | Route | Recommendation |
|---|---|---|---|
| Webhook CSRF exemption relies on route-group placement, not an explicit annotation | Low | `/webhooks/v1/*` | Currently correct (mounted under `api` group, which has no CSRF middleware) — but this is an implicit property of `bootstrap/app.php`'s routing setup rather than a self-documenting `withoutMiddleware([VerifyCsrfToken::class])` on the webhook routes themselves. Low risk today; worth a comment or explicit `withoutMiddleware` for defense-in-depth if the middleware stack is ever restructured |
| No committed secrets found | N/A (informational) | — | `git ls-files` shows no `.env`, `.env.backup`, `.env.production`, `oauth-*.key`, `.phpunit.cache`, or `storage/phpstan/*` tracked — `.gitignore` correctly excludes all of these |
| Security headers present globally | N/A (informational, verified Pass) | all routes | `SecurityHeaders` middleware appended globally in `bootstrap/app.php`; `SecurityHeadersTest` passes for both baseline headers and the storefront CSP header |
| Rate limiting present and tested | N/A (informational, verified Pass) | `login`, `checkout`, `cart`, `webhook`, `api` | All 5 limiters defined in `AppServiceProvider::boot()`; `RateLimitingTest` (4 tests) passes, covering per-IP+email login limiting, per-user checkout limiting, and per-IP webhook limiting |
| Passport keys not committed | N/A (informational, correct) | `/oauth/*` | `storage/oauth-private.key`/`oauth-public.key` correctly gitignored per CLAUDE.md's documented gotcha; feature tests generate throwaway keys in `setUp()` |

No SQL injection, mass-assignment, or missing-authorization issues were found in the controllers/policies sampled. No file-upload endpoints exist yet (see §10 — this becomes a new attack surface once product images ship, and the proposal below addresses it).

## 8. Authorization Findings

| Issue | Role | Route | Recommendation |
|---|---|---|---|
| None found — record-level authorization is consistently enforced | All roles | All sampled routes | `OrderAuthorizationTest`, `PurchaseOrderAuthorizationTest`, `StockWarehouseScopeTest` all pass, proving: a retail customer cannot view another customer's order; a business buyer cannot view another account's PO/quote; an inventory manager cannot move stock outside their assigned warehouse team; staff holding the relevant blanket permission (`payment.settle`, `po.approve`) can see/act on any record. This is genuine record-level Policy enforcement, not just route-level role gating |
| Informational: `permissions_as_gates` correctly stays `false` | — | — | Verified per CLAUDE.md's documented gotcha — Policies call `$user->isAbleTo(...)` directly rather than relying on `Gate::before()`, avoiding the Laratrust team-identifier misparse bug described in CLAUDE.md |

No authorization bypass was found via direct route access in the sampled flows (checkout, stock movement, PO approval, payment settlement, reports). The 8 controller-layer Eloquent-leakage instances in §6 are all *read-only reference lookups gated behind the controller's own route middleware/FormRequest `authorize()`* — they were not found to leak unauthorized data (e.g. the Admin controllers are already gated by `admin.*` permissions before reaching those lines).

## 9. Testing Gaps

Proposed test names and what they should assert, for genuinely missing coverage (not simply "more tests" — these are the specific edge cases that matter most for this codebase, per the flows described in CLAUDE.md):

- `test_api_v1_client_credentials_token_cannot_access_buyer_owned_quote_routes` — asserts a client-credentials (service-principal) token gets a 403/422 on POST `/api/v1/b2b/quotes`, since CLAUDE.md states buyer-owned quote/PO/payment routes require a real `User` token, not a service principal.
- `test_api_v1_response_envelope_is_data_meta_shape` — HTTP-level test hitting `/api/v1/catalog/products` asserting the JSON body has top-level `data` and `meta` keys, per the documented API Resource envelope contract.
- `test_duplicate_paymob_webhook_with_same_gateway_ref_does_not_double_settle` — mirrors the existing `duplicate fake gateway webhook is a no op` test but specifically for the Paymob/Fawry placeholder controllers, to lock in the idempotency contract before real credentials are wired in.
- `test_audit_log_entry_is_not_created_if_the_wrapping_transaction_rolls_back` — directly exercises the "audit entry can't exist without its action having committed" guarantee CLAUDE.md claims for `AuditService::record()`; force a failure partway through e.g. `PurchaseOrderService::approve()` and assert zero `activity_log` rows were written.
- `test_admin_can_edit_role_permissions_and_cache_invalidates_for_holders` — asserts `RolePermissionService::syncPermissions()` actually invalidates the Laratrust permission cache for a user who already holds that role and is mid-session (not just a freshly-logged-in user).
- `test_import_batch_partial_failure_still_marks_batch_completed_with_error_report` — an end-to-end version of the row-level-failure tests already present, verifying the downloadable CSV error report endpoint (`/imports/{importBatch}/errors/download`) returns the correct failed rows, not just that `import_rows.error` gets populated.
- `test_vendor_cannot_upload_image_for_another_vendors_product` — forward-looking, to be added alongside the product image feature (§10) — vendor `ProductPolicy`-style "own product" scoping needs the same test pattern already proven for quote pricing (`vendor cannot price a quote outside their own products`).

## 10. Product Image Feature Proposal

### Current state (verified, not assumed)

Searched the entire codebase for any trace of product images:
- `database/migrations/2026_07_07_003005_create_products_table.php` — no `image`/`photo`/`thumbnail` column of any kind.
- No `product_images` table in any migration.
- `composer.json` — no `spatie/laravel-medialibrary` or any other media-library package installed.
- No `Storage::` usage found in `app/Http/Controllers`, `app/Services`, or `app/Models` relating to products (Excel import uses `Storage` only for the uploaded `.xlsx` file itself, not images).
- No file-upload `FormRequest` for products exists.
- No product image UI component (`ProductCard`, `Products/Show.jsx`, etc. — checked `resources/js/Pages/Catalog/Products` and `resources/js/Pages/Storefront/Products`) renders an `<img>` tied to product data; there is no placeholder-image convention either.
- `Api/V1` product/catalog resources expose no image field.
- Excel import (`app/Imports`) has no image-related column mapping.

**Conclusion: products currently support zero images, in any layer, anywhere in the stack.** This is a genuine feature gap, not an oversight of the audit — it simply hasn't been built yet.

### Proposed implementation (NOT implemented — proposal only)

**Schema**: new `product_images` table, UUID PK (matching every other business table's convention except `users`), columns: `product_id` (UUID FK, cascade delete), `disk` (string, default `public`), `path` (string), `original_name` (string), `alt_text` (nullable string), `sort_order` (unsigned integer, default 0), `is_primary` (boolean, default false), timestamps. Add a unique partial-intent constraint enforced at the Service layer (not DB-level, since "only one primary per product" is awkward as a raw unique index) — `ProductImageService::setPrimary()` unsets any existing primary in the same transaction.

**Model relationships**: `Product::images()` (`hasMany(ProductImage::class)->orderBy('sort_order')`), `Product::primaryImage()` (`hasOne(ProductImage::class)->where('is_primary', true)`, or fallback to first `sort_order` if none flagged — decide explicitly, don't leave it implicit). New `ProductImage` model, `belongsTo(Product::class)`.

**Service**: new `ProductImageService` (mirrors the existing Service pattern — no controller touches `ProductImage` directly): `upload(Product $product, UploadedFile $file, ?string $altText = null): ProductImage`, `setPrimary(ProductImage $image): void`, `reorder(Product $product, array $orderedIds): void`, `delete(ProductImage $image): void` (also deletes the underlying file via `Storage::disk($image->disk)->delete($image->path)` inside the same transaction as the DB delete, so a failed file-delete doesn't leave an orphaned DB row pointing at nothing — or vice versa).

**FormRequests**: `StoreProductImageRequest` (`authorize()`: `product.manage` AND, for a Vendor, `$this->product->supplier_id === $user->supplier->id` or equivalent "own product" check mirroring `ProductPolicy`; `rules()`: `image` file, mimes `jpg,jpeg,png,webp`, max size e.g. 4MB, dimension constraints if desired), `UpdateProductImageRequest` (alt text/primary flag), `ReorderProductImagesRequest` (array of UUIDs belonging to the same product, validated with an `exists` + ownership check, not just `exists`).

**Authorization rules**: reuse `product.manage` permission (no new permission needed — mirrors the existing "reports reuse existing permissions" pattern already established in the Admin/Reports module per CLAUDE.md). Vendor: own-product-only (extends `ProductPolicy`'s existing ownership check, don't invent a parallel mechanism). Business Buyer/Retail Customer: no upload capability at all — image routes gated the same way `catalog.products.store/update/destroy` already are. Public storefront: only images belonging to `is_active` products are ever served through the storefront-facing image URL/resource — mirror the existing "inactive product is not visible in public listing" pattern (`PublicBrowsingTest`) with a new `test_inactive_product_images_are_not_served_via_storefront` test.

**Routes** (nested under the existing `catalog/products/{product}` group in `routes/web.php`, respecting the existing route-order gotcha about `/create` vs `/{product}`):
- `POST /catalog/products/{product}/images` → `Web\Catalog\ProductImageController@store`
- `PATCH /catalog/products/{product}/images/{image}` → `@update` (alt text / set-primary)
- `POST /catalog/products/{product}/images/reorder` → `@reorder`
- `DELETE /catalog/products/{product}/images/{image}` → `@destroy`

**UI changes**:
- `resources/js/Pages/Catalog/Products/Create.jsx` / `Edit.jsx`: new `ProductImageUploader` component (drag-drop or file input, multi-file, preview before upload).
- `resources/js/Pages/Catalog/Products/Show.jsx`: new `ProductImageGallery` component with drag-to-reorder and a "set primary" action.
- `resources/js/Pages/Storefront/Products/Index.jsx` and its `ProductCard` component: render `primary_image.url` with a graceful fallback placeholder (SVG or CSS-only, not a missing-image icon) when a product has no images yet.
- `resources/js/Pages/Storefront/Products/Show.jsx`: full gallery view (thumbnail strip + main image), reusing `ProductImageGallery` in a read-only mode.
- New shared component: `resources/js/Components/ProductImage/PrimaryImage.jsx` (a single `<img>` wrapper with the fallback logic centralized so it isn't duplicated across `ProductCard` and `Products/Show`).

**API v1**: add an `images` field (array of `{id, url, alt_text, is_primary}`) to whatever `App\Http\Resources\Api\V1\ProductResource` currently returns — this is additive, doesn't break the existing envelope contract.

**Excel import strategy**: do **not** attempt image import in the first pass. Recommend: Phase 1 ships manual upload only (the UI above); Phase 2 (only if there's demonstrated demand) adds an `image_url` column to the product import template that triggers a queued background fetch-and-store job (reusing the existing `ImportCatalogJob`/queue infrastructure), because synchronously downloading N images per import row inside the existing 100-row chunk processing would risk request/job timeouts and turn transient network failures into spurious row-level import errors. A ZIP-based bulk image import (row references a filename inside an uploaded ZIP) is a reasonable Phase 3 if `image_url` proves insufficient, but adds real complexity (ZIP extraction, path traversal validation) that isn't justified without a concrete need.

**Storage setup**: use the `public` disk (already Laravel's default local-public disk convention), require `php artisan storage:link` as a one-time setup step (document it in `stockflow/README.md` next to the existing `make start` instructions). Tests should use `Storage::fake('public')` and assert both the DB row and the fake-disk file existence, following the same testing pattern already used for the Excel import's uploaded-file handling.

**Test list**:
- `test_vendor_can_upload_image_for_own_product`
- `test_vendor_cannot_upload_image_for_another_vendors_product`
- `test_business_buyer_cannot_upload_product_image`
- `test_retail_customer_cannot_upload_product_image`
- `test_setting_a_new_primary_image_unsets_the_previous_primary`
- `test_reordering_images_persists_sort_order`
- `test_deleting_an_image_removes_both_db_row_and_stored_file`
- `test_inactive_product_images_are_not_served_via_storefront`
- `test_product_with_no_images_falls_back_to_placeholder_in_storefront_ui` (a React/Inertia component-level or Dusk-style test, if the project ever adds JS test tooling — currently there is none, so this may need to remain a manual/visual check unless JS testing infra is added)
- `test_api_v1_product_resource_includes_primary_image_url`

### MVP-friendly now, or Phase 2?

**Recommend Phase 2, not immediate MVP scope.** Reasoning: every other module in this codebase (stock, checkout, procurement, payments, imports, admin/reports) is a complete, tested, end-to-end vertical slice — the project's evident engineering discipline is "finish a module fully before starting the next." Product images are a genuinely separate vertical (new table, new Service, new FormRequests, new file-upload attack surface requiring its own security review, new UI components across both Catalog admin and Storefront) rather than a small addition to an existing module. Bolting it on quickly would break the project's own established pattern of "Service does the transaction, Policy does the authorization, tests prove the contract" — better to give it the same full treatment as the other five modules got, in its own pass, than to rush a thinner version into the current module's scope.

## 11. Suggested Implementation Backlog

**Critical**: none identified — no correctness, security, or data-integrity defect found that blocks demo or continued development.

**High**:
- Implement the product image feature end-to-end per §10 (schema → Service → Policy → routes → UI → tests), as its own module pass.
- Add HTTP-level `tests/Feature/Api/V1/*` tests confirming the `{data, meta}` envelope, Passport scope enforcement, and client-credentials read-only restriction (§9, first two items).

**Medium**:
- Refactor the 8 controller-layer direct-Eloquent-lookup call sites (§6, finding 1) into Repository methods for architectural consistency.
- Add the audit-log transactional-rollback test and the Paymob/Fawry duplicate-webhook idempotency test (§9).
- Confirm (or add) a dedicated Admin role-permission-cache-invalidation test (§9).

**Nice-to-have**:
- Document the implicit CSRF-exemption mechanism for `/webhooks/v1` more explicitly (§7) — e.g. a comment in `bootstrap/app.php` or an explicit `withoutMiddleware` call — as defense-in-depth against a future refactor accidentally moving webhooks into the `web` group.
- Add the import-batch error-report end-to-end download test (§9).

## 12. Final Recommendation

**Demo/portfolio readiness: Ready now.** Every documented business flow was independently verified against the code (not just CLAUDE.md's word), the full quality gate passes cleanly, and the stock ledger's core integrity guarantee (`stock:reconcile`) holds. This is a genuinely strong showcase of layered Laravel architecture, transactional discipline, and test coverage.

**Production readiness: Not yet — a few gaps to close first.** The two real gaps are (1) no product images, which is a normal, expected e-commerce feature and a visible UX gap for any real storefront, and (2) Paymob/Fawry are intentionally-unfinished placeholders, meaning no real payment provider is live yet. Neither is a defect — both are honestly documented as unfinished — but "production" implies real payment processing and a storefront with product photography, so treat those two as the literal remaining checklist items before a production launch, alongside the Medium-priority test-coverage additions in §11.
