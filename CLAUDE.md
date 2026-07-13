# StockFlow

B2B/B2C e-commerce & inventory platform. Laravel + Inertia.js + React, one app.
Stock is the source of truth: every purchase-in and sale-out is an immutable ledger
entry (`stock_movements`); current stock is always derivable from that ledger.

This is a **brand-new project**. Nothing is inherited from the old CMS project
(`../CMS`) — do not copy its folder structure, patterns, or code.

## Read this first

**`docs/project/canonical-decisions.md`** is the single arbitration reference for this
project. The three source documents in `docs/source/` were written at different times
and disagree on scope/stack/terminology in places — when in doubt, or when a source
doc conflicts with another, canonical-decisions.md wins. It covers:

- source-of-truth document order
- architecture, auth, route, and folder decisions
- the stock/ledger model
- API versioning
- a list of deprecated ideas from earlier drafts that must NOT be reintroduced

Read it before proposing any architecture or scaffolding.

## Source documents

- `docs/source/StockFlow-Enterprise-PRD.md.pdf` — Enterprise PRD v2.0, approved,
  highest precedence. Schema, security, workflows, delivery plan.
- `docs/source/USER_STORIES.md.pdf` — acceptance criteria at story level.
- `docs/source/PRD.md.pdf` — earlier draft PRD v1.0, historical background only.
- `docs/source/erd.png` — visual schema reference (secondary to the PRD's written
  schema in Section 6 if they ever disagree).

## Non-negotiable architecture facts

- One Laravel app (scaffolded as Laravel 13.18.1 — `composer create-project` no
  longer produces Laravel 12; see "Known deviations" below). Inertia + React. No
  Next.js, no separate SPA, no React Router.
- Human UI: session auth (`web` guard) only. No Passport token ever touches the
  browser for human sessions.
- Laravel Passport: external B2B API only, under `/api/v1`, namespaced
  `App\Http\Controllers\Api\V1`. Installed and configured; do not use Passport for
  browser/Inertia sessions.
- Payment webhooks: `/webhooks/v1`, CSRF-exempt, signature-verified where provider
  supports it, and idempotent via `payments.gateway_ref`. Implemented for
  Paymob/Fawry placeholders and the demo Fake Gateway; real Paymob/Fawry API
  contracts/credentials are still future work.
- Excel import: `maatwebsite/excel`, `/imports` UI, `import.run`, queued
  `ImportCatalogJob`, `import_batches` + per-row `import_rows`, row-level failures,
  natural-key upserts, downloadable error report, and opening stock through
  `StockService` only.
- External API: `/api/v1`, `auth:api`, JSON-only, Passport scopes
  (`catalog:read`, `orders:write`, `stock:read`, `payments:write`), Laratrust
  permissions/policies, rate limited, and `{data, meta}` API Resource envelopes.
  Password grant is for B2B users. Client credentials are supported as scoped
  service principals for read-only catalog/stock routes only; buyer-owned quote,
  PO, and payment routes require a real `User` token.
- Layering: **Controller → FormRequest → Service → Repository → Model.** Controllers
  never call Eloquent directly; FormRequests own `authorize()`/`rules()`; Services own
  business rules/transactions; Repositories own Eloquent queries; Policies own
  record-level authorization. Web and API controllers call the same Services.
- Stock mutations: `DB::transaction()` + `lockForUpdate()`, no oversell under
  concurrency, `stock:reconcile` proves ledger == `stock_levels`. **Implemented** —
  see "Current state" below.

## Roles

SuperAdmin, Inventory Manager, Sales/Cashier, Vendor/Supplier, Business Buyer, Retail
Customer — enforced with Laratrust; warehouse-scoped roles use Laratrust teams (one
team per warehouse). Seeded by `RolePermissionSeeder` per the PRD §3 permission
matrix; demo users seeded by `DemoUserSeeder` (SuperAdmin) and
`DemoBusinessAccountSeeder` (Business Buyer).

## Current state (what's actually built)

- **Local dev infra**: Docker Compose (`app`, `mysql`, `redis`, `queue` — runs
  `artisan horizon`, `scheduler`, `vite` services). `make start` / `make test` /
  `make migrate` / `make quality` etc. — see `stockflow/Makefile` and
  `stockflow/README.md`.
- **Auth**: session login/logout plus public retail registration
  (`Web/Auth/LoginController`, `Web/Auth/RegisterController`, `AuthService`).
- **Authorization**: Laratrust roles/permissions (teams enabled), `ProductPolicy`,
  `PriceListPolicy` (also covers `PriceListItem`), Admin UI for user/role management
  and a read-only permission matrix.
- **Database schema**: all core tables migrated (business_accounts, warehouses,
  suppliers, categories, products, price_lists/price_list_items, stock_movements,
  stock_levels, orders/order_items, quotes/quote_items, purchase_orders/po_items,
  po_approvals, payments, import_batches/import_rows, activity_log) with UUID PKs,
  enums, models, factories, and demo seeders.
- **Shared backend architecture**: `app/Services`, `app/Repositories` (+`Contracts`),
  `app/Exceptions` (domain exceptions), `app/Payments`, `app/Support` scaffolded.
  `CatalogService`, `AuthService`/`RoleAssignmentService`, `StockService`,
  `OrderService`, `PaymentService`, `QuoteService`, `PurchaseOrderService`,
  `ImportService`, `AuditService`, `RolePermissionService`, `ReportService`, and
  `DashboardService` have real logic.
- **Catalog/storefront module** (first full business module, the template for
  future ones): products/categories/suppliers/price-lists CRUD, Redis-cached reads
  (tag `catalog`, flushed on every write), vendor-scoped price-list-item ownership,
  public product browsing, and a session-backed guest cart.
- **Stock engine** (second full business module — see `stockflow/README.md` §"The
  stock engine" for the full write-up): `StockService::purchaseIn() / reserve() /
  release() / confirmSale() / transfer() / adjust() / reconcile()` — every mutation
  transactional, row-locked (`lockForUpdate()`), no oversell, no negative stock,
  exactly one (or two, for `transfer()`) immutable `stock_movements` row per
  mutation. Web UI at `/stock/levels`, `/stock/movements`, `/stock/adjustments`,
  `/stock/transfers`, `/stock/reconcile`, gated by `stock.read`/`stock.move`/
  `stock.transfer`/`audit.read` and `StockPolicy` + `WarehouseScopeMiddleware`
  (Laratrust team-scoped: one team per warehouse, auto-created via
  `Warehouse::booted()`). `php artisan stock:reconcile` is CI-checkable (non-zero
  exit on ledger/projection drift). Concurrency (no-oversell under a real race) is
  proven in `tests/Feature/Stock/StockConcurrencyTest.php` via two separate OS
  processes racing `reserve()` against real MySQL row locks.
- **B2C checkout module** (third full business module — cart → checkout →
  payment → fulfillment): `OrderService` owns the state machine `pending →
  reserved → confirmed → fulfilled` (with `reserved`/`pending` → `cancelled`);
  every stock mutation is delegated to `StockService::reserve()` /
  `confirmSale()` / `release()` — `OrderService` never writes `stock_movements`
  itself. `checkout()` prices lines from the active `b2c_retail` price list
  (`CatalogService::retailPriceFor()`), picks a fulfillment warehouse per line
  (`StockService::bestWarehouseFor()` — most-available-stock heuristic, not a
  customer choice in v1), and reserves every line inside one `DB::transaction()`
  — any line failing (`OutOfStockException`/`PricingUnavailableException`) rolls
  back the whole checkout, including the `Order`/`OrderItem` rows themselves, so
  a failed checkout leaves zero trace. VAT is a fixed 14% (`OrderService::
  VAT_RATE`), computed with `bcmath` (not float math) to avoid rounding drift on
  money. `orders.reserved_until` (30 min from checkout,
  `OrderService::RESERVATION_TTL_MINUTES`) is released by `php artisan
  stock:release-expired-reservations` (now fully implemented, scheduled
  every-minute in `routes/console.php`) via `OrderService::
  releaseExpiredReservations()` → `cancel()`.
  Payment methods (`PaymentMethod` enum + one driver each under `app/Payments`,
  resolved by `PaymentService::resolveGateway()`): `fake_gateway` is demo/test-only
  and runs through the same verified callback path as provider webhooks; `cod`
  remains pending until authorized staff confirms cash collection; `paymob`/`fawry`
  are signed-webhook placeholders with clear TODOs for live contracts/credentials;
  `bank_transfer` is used for B2B settlement. `PaymentService` is now the
  idempotency and transaction boundary: it locks the `payments` row, updates
  `status`/`gateway_ref`, and calls `OrderService::confirmPayment()` or
  `PurchaseOrderService::settle()` inside the same DB transaction. Duplicate
  callbacks are no-ops and cannot write a second `sale_out`. Staff
  (`payment.settle`) settle a pending payment via `POST /payments/{payment}/settle`
  → `PaymentService::settleManually()`. Web UI at `/cart`, `/checkout`, `/orders`,
  `/orders/{order}`, `/payments`, `/payments/{payment}`, gated by `sale.create`
  (checkout) and
  `OrderPolicy`/`PaymentPolicy` (record-level: a customer sees only their own
  orders/payments; staff holding `payment.settle` can see and settle any).
  Cart is session-backed (`CartService`, `[product_id => quantity]` in the
  Laravel session) — deliberately not a DB table, since requirement #1 only
  requires *order creation* to be database-backed, and prices are always looked
  up fresh rather than cached in the session. Cart add/update validates the desired
  total quantity against live `StockAvailabilityService` data, rejects quantities
  above available stock with a generic message, and never reserves or mutates stock
  before checkout. Public registration assigns only the Retail Customer role and
  preserves the guest cart so checkout redirects can continue after registration.
- **B2B procurement module** (fourth full business module — RFQ → quote → PO →
  approval → settlement): two state machines, `QuoteService` (`draft → sent →
  accepted | rejected | expired`) and `PurchaseOrderService` (`pending_approval →
  approved → fulfilled → closed`, or `pending_approval → rejected`). A Business
  Buyer's `request()` creates a `draft` quote with lines but no prices
  (`quote_items.unit_price` starts at `0.00`); a Vendor (their own products only —
  "own pricing context", `QuotePolicy::price()`) or Inventory Manager prices every
  line and the quote moves to `sent` with a 14-day expiry
  (`QuoteService::VALIDITY_DAYS`). `QuoteService::accept()` is never called from a
  controller directly — only `PurchaseOrderService::createFromQuote()` calls it,
  inside the same `DB::transaction()` that creates the `PurchaseOrder` +
  `PoItem`s, so "accept the quote" and "create the PO" always happen together or
  neither does. **Creating the PO does NOT reserve stock** — it only picks a
  fulfillment warehouse per line (`StockService::bestWarehouseFor()`, same
  heuristic as B2C); reservation happens only at `approve()` time. `approve()`
  locks the `business_accounts` row (`BusinessAccountRepository::lockForUpdate()`,
  so two concurrent approvals against the same account can't both pass against a
  stale balance), checks `outstanding_balance + PO total <= credit_limit`
  (`bccomp`, not float comparison — throws `CreditLimitExceededException` if it
  would be exceeded), then reserves every line via `StockService::reserve()` and
  adds the PO total to `outstanding_balance`. Bank Transfer settlement
  (`PurchaseOrderController::bankTransferStore()`) calls
  `PaymentService::initiate()` + `settleManually()` using `BankTransferGateway`;
  the payment update and `PurchaseOrderService::settle()` happen inside the same
  transaction, converting every line's reservation to a sale via
  `StockService::confirmSale()` and paying down `outstanding_balance`. Web UI at
  `/procurement/quotes/*` and
  `/procurement/purchase-orders/*`, gated by `quote.request` (Business Buyer),
  `quote.price` (Vendor/Inventory Manager), `po.approve`, `payment.settle`, with
  `QuotePolicy`/`PurchaseOrderPolicy` doing "own account" / "own pricing context"
  record-level scoping (staff holding `po.approve`/`payment.settle` can see/act on
  any). `PaymentPolicy` now branches on payable type (`Order` for B2C,
  `PurchaseOrder` for B2B) since both share the polymorphic `payments` table.
- **Admin/audit/dashboard/reports module** (fifth full module — no new business
  entity, wraps observability/administration around everything above):
  `AuditService::record()` is the only writer of `activity_log` (mirrors
  `StockService` being the only writer of `stock_movements`) — called from inside
  `StockService::adjust()`, `PurchaseOrderService::approve()`/`reject()`,
  `PaymentService`'s `confirmVerifiedPayment()` (covers manual settlement, webhook
  confirmation, and the Fake Gateway simulator uniformly, since all three funnel
  through that one method), `RoleAssignmentService::syncRoles()`, and the new
  `RolePermissionService::syncPermissions()` — never from a Controller directly, so
  an audit entry can't be recorded without the action it describes actually having
  committed (both live inside the same `DB::transaction()`). Fixed event vocabulary:
  `stock.adjusted`, `po.approved`, `po.rejected`, `payment.settled`,
  `user.roles_updated`, `role.permissions_updated` — see
  `AuditLogController::EVENTS`. `RolePermissionService` is module 4's "role/permission
  management improvement": `Admin/Roles/Index.jsx` now edits a role's own permission
  set inline (`Role::syncPermissions()` already self-invalidates Laratrust's cache
  for every user holding that role — no separate cache-busting step needed).
  `DashboardService::kpisFor()` returns a small, cheap COUNT/SUM bundle
  (`low_stock_count`, `pending_po_approvals`, `pending_payments`,
  `todays_sales_total`, `recent_activity`) cached for 60s per viewer scope (staff
  share one global cache entry; a Business Buyer gets one scoped to their
  `business_account_id`; a bare Retail Customer with no staff permission gets
  `scope: 'none'` rather than leaking store-wide numbers) — a short-TTL cache, not
  CatalogService's tag-and-flush-on-write pattern, because dashboard reads don't
  vastly outnumber writes the way catalog reads do. Five reports
  (`ReportService` → one paginated, filtered repository query each):
  low stock (`StockRepository::paginateLowStockLevels()`, `available <= threshold`,
  default 10), stock movements (extends the existing `paginateMovements()` with
  `actor_id`/`date_from`/`date_to` — additive, doesn't change the Stock/Movements
  page's own calls), sales (`OrderRepository::paginateForSalesReport()`, product/
  warehouse filters go through `whereHas('items', ...)` since those columns live on
  `order_items`), payments (`PaymentRepository::paginateForReport()`, "user" means
  the payable's owner — `Order.user_id` or `PurchaseOrder.businessAccount.user_id`,
  no product/warehouse dimension since payments don't have one), and import history
  (`ImportRepository::paginateForReport()`, `entity` stands in for "product" since a
  batch spans many rows/entities). New indexes for report filtering:
  `payments(status, created_at)` + `payments(method)`,
  `import_batches(status, created_at)`, `activity_log(causer_id, created_at)` +
  `activity_log(event)`. Web UI at `/admin/audit-log` (`audit.read`) and
  `/reports/{low-stock,stock-movements}` (`stock.read`),
  `/reports/{sales,payments}` (`payment.settle`), `/reports/imports`
  (`import.run|audit.read`) — no new permissions invented, each report reuses
  whichever existing permission maps to its domain.
- **Excel import module**: `composer require maatwebsite/excel` installed
  `maatwebsite/excel` + PhpSpreadsheet. Web UI at `/imports`, gated by
  `import.run`; `StoreImportRequest` authorizes uploads, `ImportService::start()`
  creates an `import_batch`, stores the file, and dispatches `ImportCatalogJob`.
  `ImportService::run()` reads heading rows, creates `import_rows`, processes
  pending rows in 100-row chunks, catches row-level validation failures into
  `import_rows.error`, and marks the batch `completed` even when some rows fail.
  Upserts use natural keys: category slug, product SKU, warehouse code, supplier
  email/name, and price-list name/type + SKU/min_qty. `opening_stock.quantity` is a
  target on-hand value and mutates stock only through `StockService` (`purchaseIn`
  for an initial positive quantity, `adjust` for deltas), then reconciles the touched
  product/warehouse pair. Error report UI and CSV live at
  `/imports/{importBatch}/errors`.
- **Hardening pass** (performance/reliability/CI, no new business entity): see
  `stockflow/docs/technical/cache.md` and `stockflow/docs/technical/indexing.md` for
  full detail. Summary:
  - `StockService::listLevels()` (the Stock/Levels report page only) is now cached
    (tag `stock-levels`, 30s TTL, flushed on every `recordMovement()` call — the
    single choke point every mutation funnels through). Every other `StockService`
    read (`findLevel()`, `lockLevelForUpdate()`, `lockOrCreateLevel()`,
    `bestWarehouseFor()`, `reconcile()`'s ledger/projection totals) stays live and
    uncached deliberately — caching a locked-mutation decision or a reconciliation
    proof would defeat the point of the ledger.
  - `DatabaseSeeder::run()` now calls `Cache::flush()` before seeding, and `make
    fresh` runs `cache:clear` after `migrate:fresh`. Fixes a real bug: bigint
    auto-increment IDs (see "known deviation" above) get reused across a
    `migrate:fresh`, so a stale Laratrust permission-cache entry keyed by ID from a
    *previous* seeding pass survived and got served to the newly-seeded SuperAdmin,
    making them look unauthorized everywhere. Regression test:
    `tests/Feature/Admin/SeededSuperAdminAccessTest.php`.
  - Rate limiters (`AppServiceProvider::boot()`): `login` (5/min, keyed by
    IP+email), `checkout` (10/min per user), `webhook` (60/min per IP, applied to
    the whole `/webhooks/v1` group in `bootstrap/app.php`), `api` (120/min per
    token/IP, pre-existing).
  - Laravel Horizon supervises the redis queue (`docker-compose.yml`'s `queue`
    service now runs `artisan horizon` instead of a plain `queue:work` process).
    Dashboard at `/horizon`, gated to SuperAdmin only
    (`HorizonServiceProvider::gate()` — Horizon exposes job payloads/failures with
    no equivalent entry in the PRD's permission matrix, so it's a direct role
    check, not a new granular permission). `config/horizon.php`'s
    `defaults.tries`/`backoff` (3/3) preserve the retry behavior the old
    `queue:work --tries=3 --backoff=3` flags gave `ImportCatalogJob`, which
    declares no `$tries` of its own.
  - `App\Http\Middleware\SecurityHeaders` (registered globally in
    `bootstrap/app.php`) sets `X-Content-Type-Options`, `X-Frame-Options`,
    `Referrer-Policy`, `Permissions-Policy` on every response, plus
    `Strict-Transport-Security` on HTTPS requests and a `Content-Security-Policy`
    that defaults to self-origin while allowing local Vite HTTP/WebSocket origins
    for development/test.
  - Code quality gate: `pint.json` (Laravel preset), `phpstan.neon` +
    `phpstan-baseline.neon` (Larastan, level 5, 250 pre-existing findings
    baselined — mostly Larastan false positives on enum `casts()` methods, not
    real bugs; `treatPhpDocTypesAsCertain: false` documents why). `make quality`
    runs pint + stan + the full test suite in one command. `.github/workflows/
    ci.yml` runs the same three gates on every push/PR, with MySQL + Redis service
    containers for the handful of tests that need real DB/cache semantics
    (`tests/Concerns/UsesRealMysqlDatabase.php`).
- **External B2B API module**: `composer require laravel/passport`; Passport config
  and migrations are published. `User` uses `HasApiTokens`, `auth.guards.api` uses
  the `passport` driver, and `AppServiceProvider` enables the password grant, refresh
  rotation, 15-minute access tokens, 30-day refresh tokens, client-credentials tokens,
  and the four approved scopes. `routes/api.php` is mounted by `bootstrap/app.php`
  under `/api/v1`, guarded by `api.json`, `api.client-principal`, `auth:api`,
  `throttle:api`, `scope:*`, and Laratrust `permission:*` using `guard:api`.
  `ApiClientPrincipal` maps client-credentials service clients to read-only
  catalog/stock permissions. Controllers live in `App\Http\Controllers\Api\V1` and
  call `CatalogService`, `StockService`, `QuoteService`, `PurchaseOrderService`, and
  `PaymentService`; resources live in `App\Http\Resources\Api\V1`; request validation
  and policies live in `App\Http\Requests\Api\V1`. Public docs: `docs/api-v1.md`.

## Known deviations from the PRD (flagged, not silently "fixed")

- **`users.id` is a bigint auto-increment, not a UUID** — the PRD specifies UUID PKs
  everywhere including `users`. Every FK to `users` (business_accounts.user_id,
  stock_movements.actor_id, orders.user_id, po_approvals.approver_id,
  import_batches.uploader_id, activity_log.causer_id, suppliers.user_id) is
  `unsignedBigInteger` to match. Don't "fix" this without an explicit decision — it
  would ripple through the whole auth/session/Laratrust layer.
- Framework resolved to **Laravel 13.18.1**, not 12, purely because that's what
  `composer create-project laravel/laravel` produces now. Nothing in the codebase
  assumes Laravel-12-specific APIs.

## Known gotchas (hit once already — don't re-debug these from scratch)

- **`config/laratrust.php` `permissions_as_gates` must stay `false`.** When `true`,
  Laratrust's `Gate::before()` hook treats the first non-boolean argument to *any*
  Gate/Policy check as a team identifier. So `$user->can('create', Product::class)`
  gets misread as "check team named `App\Models\Product`" and throws
  `ModelNotFoundException` for a `Team`. Our Policies call `$user->isAbleTo(...)`
  directly instead, so this flag isn't needed. If a raw ability-name check (no model
  arg) needs to work outside a Policy, call `$user->isAbleTo(PermissionName::X->value)`
  directly rather than re-enabling this.
- **`config/cache.php` `serializable_classes` must stay `true`.** Laravel's shipped
  default (`false`) makes `unserialize()` convert *every* cached object into
  `__PHP_Incomplete_Class` — silently corrupting any cached Eloquent
  Collection/Paginator on the second read. Invisible under the test suite's `array`
  cache driver (it never actually serializes), only shows up against real Redis. All
  values `CatalogService` (and future services) cache originate from trusted
  server-side queries, never user input, so the gadget-chain risk this setting guards
  against doesn't apply here.
- **Base `App\Http\Controllers\Controller` needs `AuthorizesRequests`.** The Laravel
  skeleton no longer includes it by default; without it `$this->authorize()` doesn't
  exist. Already added — don't remove it.
- **Route order matters for `/{model}` wildcards.** e.g. `/products/create` must be
  registered before `/products/{product}`, or "create" gets parsed as a product id.
  See `routes/web.php`'s catalog group for the pattern to copy.
- **`migrate:fresh` does not touch Redis.** If you're debugging something that looks
  like stale/impossible cached data after a DB reset, run `php artisan cache:clear`
  before assuming it's a code bug.
- **Schema/cache/concurrency tests that need real MySQL/Redis semantics** (FULLTEXT,
  real unique constraints, real row locking, real serialization) can't use the
  suite's default SQLite/array drivers. Pattern to copy:
  `tests/Concerns/UsesRealMysqlDatabase.php` (a shared trait — switches to a
  dedicated `stockflow_testing` MySQL DB, never the dev DB; used by
  `DatabaseSchemaTest` and `StockConcurrencyTest`) and
  `tests/Feature/Catalog/CatalogCacheTest.php`'s
  `test_catalog_cache_survives_a_real_redis_round_trip` (switches `cache.default` to
  `redis` for one test, restores it in `finally`). For proving no-oversell under a
  genuine race (not just correctness in isolation), PHPUnit is single-threaded, so
  `StockConcurrencyTest` spawns two real OS processes via `proc_open()`
  (`tests/Concurrency/reserve_once.php`, a standalone script that boots its own
  Laravel app instance) rather than trying to fake concurrency within one process.
- **A subclass redeclaring a parent's `$fillable`/`$guarded` doesn't erase the
  parent's.** `App\Models\Team extends Laratrust\Models\Team`, which already
  declares a non-empty `protected $fillable = ['name', 'display_name',
  'description']`. Setting `public $guarded = []` on the child does nothing —
  Eloquent's `isFillable()` checks `$fillable` first whenever it's non-empty, so
  `warehouse_id` (added via a migration to link warehouses ↔ Laratrust teams) was
  silently stripped from every mass-assignment. Fix: redeclare `$fillable` itself in
  the child, including the new column. If a mass-assignment to a subclassed model
  silently drops a column that's clearly in `$guarded = []`, check whether a parent
  class already declares `$fillable`.
- **Widening a `$table->enum()` column later must use `Blueprint::change()`, not raw
  `ALTER TABLE ... MODIFY ... ENUM(...)`.** Adding `PaymentMethod::FakeGateway` required
  widening `payments.method`'s enum values after the fact. Raw SQL (`DB::statement`)
  is MySQL-only syntax and breaks the test suite's default SQLite `:memory:`
  connection outright (no `ENUM` type, no `MODIFY COLUMN`). `Schema::table(...,
  fn ($table) => $table->enum('method', [...])->change())` works on both — see
  `database/migrations/2026_07_07_222923_add_fake_to_payments_method_enum.php`
  and the follow-up `2026_07_08_000001_rename_fake_payment_method_to_fake_gateway.php`.
  Verify any enum-widening migration against both `php artisan test` (SQLite) and
  `php artisan migrate` in the `app` container (MySQL) before considering it done.
- **A generic `App\Exceptions\DomainException` render handler in `bootstrap/app.php`
  redirects back with `flash.error`** (registered after the more specific
  `AuthorizationException`/`UnauthorizedWarehouseException` handlers, so those still
  win for their subtypes). Any new domain exception — `OutOfStockException`,
  `PricingUnavailableException`, `InvalidStateTransitionException`, etc. — gets this
  "clean rejection" behavior for free in web controllers; don't add a per-exception
  try/catch in a controller unless it needs a different response than a flash-error
  redirect back.
- **Bulk `insert()` bypasses Eloquent UUID/JSON/enum casts.** `ImportService` bulk
  creates `import_rows` for performance, so it must provide `id`, JSON-encoded
  `payload`, and scalar enum `status` values explicitly. If you add another batched
  import table insert, do not rely on `HasUuids` or model casts in that path.
- **Passport keys are environment-local.** `storage/oauth-private.key` and
  `storage/oauth-public.key` are ignored by git; run `php artisan passport:keys` (or
  `php artisan passport:install`) per environment before real OAuth token issuance.
  API feature tests generate throwaway keys in `setUp()` so clean test checkouts do
  not depend on committed secrets.
- **Generated analysis/test caches stay out of git.** `storage/phpstan/`,
  `.phpstan.cache/`, and `.phpunit.cache/` are ignored. If they ever show up in
  `git status`, remove them from the index with `git rm -r --cached` rather than
  deleting the working cache as part of an unrelated feature change.
- **Report filters only apply the (date range, product, warehouse, status, user)
  dimensions that actually exist on the underlying table — not all five on every
  report.** Deliberate, not an oversight: Payments has no product/warehouse column
  (a payment isn't about one product), so `PaymentRepository::paginateForReport()`
  maps "user" to the payable's owner instead and skips product/warehouse entirely;
  Import History has no single-product dimension (a batch spans many rows/entities),
  so it exposes `entity` as the natural analog instead of forcing a product filter
  that wouldn't mean anything. If a future report grows a genuine product/warehouse
  dimension, add the filter — don't assume every report needs to expose all five.
