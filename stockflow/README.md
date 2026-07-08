# StockFlow

B2B/B2C e-commerce & inventory platform. Laravel 13.18.1 + Inertia.js + React, one
app — no separate frontend, no Next.js, no React Router. See
[`docs/project/canonical-decisions.md`](../docs/project/canonical-decisions.md) for
the full set of architecture decisions.

Stock is the source of truth: every purchase-in, sale-out, reservation, release,
transfer, and adjustment is an immutable ledger entry (`stock_movements`); current
stock (`stock_levels`) is a projection that must always be derivable from that
ledger — `php artisan stock:reconcile` proves it.

## What's built so far

- **Auth & authorization**: session login/logout (`web` guard only), Laratrust
  roles/permissions with warehouse-scoped teams (one Laratrust team per warehouse),
  Admin UI for user/role management and a read-only permission matrix.
- **Catalog module**: products/categories/suppliers/price-lists CRUD, Redis-cached
  reads, vendor-scoped price-list-item ownership.
- **Stock engine** (the ledger/projection core): `StockService::purchaseIn() /
  reserve() / release() / confirmSale() / transfer() / adjust() / reconcile()`, all
  transactional and row-locked (see "The stock engine" below), plus a web UI
  (`/stock/levels`, `/stock/movements`, `/stock/adjustments`, `/stock/transfers`,
  `/stock/reconcile`) and `php artisan stock:reconcile`.
- **B2C checkout module**: session-backed cart → checkout → payment → fulfillment.
  `OrderService` owns `pending → reserved → confirmed → fulfilled` (or `cancelled`);
  see "B2C checkout" below. Web UI at `/cart`, `/checkout`, `/orders`, `/orders/
  {order}`, `/payments/{payment}`.
- **B2B procurement module**: RFQ → quote → purchase order → approval → Bank
  Transfer settlement. `QuoteService` + `PurchaseOrderService` own two linked
  state machines; see "B2B procurement" below. Web UI at `/procurement/quotes/*`
  and `/procurement/purchase-orders/*`.
- **Payment architecture**: gateway drivers behind `PaymentGateway`, signed/idempotent
  webhook routes under `/webhooks/v1`, unique `payments.gateway_ref`, and atomic
  reservation → `sale_out` conversion inside `PaymentService`.
- **Excel import**: `/imports` UI for categories, products, warehouses, suppliers,
  price lists, and opening stock. Uploads create `import_batches`, queued jobs create
  per-row `import_rows`, valid rows upsert by natural key, failed rows are reported,
  and opening stock writes through `StockService`.
- **External B2B API**: Passport-secured `/api/v1` JSON endpoints for catalog,
  stock availability, B2B quotes/POs, and bank-transfer payment proof submission.
  The API uses the same services as the Inertia controllers and returns `{data, meta}`.
- **Admin, audit, dashboard & reports**: `AuditService` records user/role changes,
  permission changes, stock adjustments, PO approvals, and payment settlement to
  `activity_log`; role/permission editing is inline on `/admin/roles`; a cached
  dashboard KPI bundle; five paginated, filtered, indexed reports (low stock, stock
  movements, sales, payments, import history). See "Admin, audit, dashboard &
  reports" below.
- **Hardening**: Redis-cached stock levels report with flush-on-write
  invalidation, rate limiting (login/checkout/webhook/API), Laravel Horizon
  (queue dashboard, SuperAdmin-gated), baseline security headers on every
  response, Laravel Pint + Larastan static analysis, and a GitHub Actions CI
  gate. See "Hardening" below.
- Not yet built: real Paymob/Fawry provider API calls/credentials.

## Requirements

- Docker + Docker Compose (recommended — see "Local setup" below)
- If running outside Docker: PHP 8.2+, Composer, Node 20+/npm, MySQL 8, Redis

## Local setup (Docker)

```bash
# from the stockflow/ directory
make start        # builds (if needed) and starts app, mysql, redis, queue, scheduler, vite
make migrate       # run migrations
docker compose exec app php artisan db:seed   # demo roles/users/warehouses/catalog
```

`make help` lists all available targets (`start`, `stop`, `restart`, `build`, `logs`,
`shell`, `migrate`, `fresh`, `test`, `pint`, `pint-fix`, `stan`, `quality`,
`npm-dev`, `npm-build`). `make quality` runs the full local gate (style + static
analysis + tests) in one command — the same three steps CI runs.

Visit `http://127.0.0.1:8000`. Guests are redirected to `/login`; authenticated users
land on `/dashboard`. `DemoUserSeeder` creates a SuperAdmin login and
`DemoBusinessAccountSeeder` creates a Business Buyer login (`buyer@stockflow.test`,
password `password`) with a linked `business_accounts` row — both need
`RolePermissionSeeder` to have run first, which a plain `db:seed` handles since
seeders run in order.

## Local setup (without Docker)

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# point DB_HOST at your local MySQL/Redis instances in .env
php artisan migrate --seed
composer run dev   # Laravel server + queue listener + Pail + Vite dev server, concurrently
```

## Tests

```bash
make test
# or: docker compose exec app php artisan test
```

The suite runs against SQLite `:memory:` by default (see `phpunit.xml`). A handful of
tests need real MySQL semantics (FULLTEXT indexes, real unique constraints, real row
locking, real Redis serialization) and switch to a dedicated `stockflow_testing`
database at runtime via the `Tests\Concerns\UsesRealMysqlDatabase` trait — they never
touch the dev database. Notably:

- `tests/Feature/Schema/DatabaseSchemaTest.php` — schema-level invariants.
- `tests/Feature/Stock/StockConcurrencyTest.php` — proves no-oversell under real
  concurrency: two separate OS processes race `StockService::reserve()` for the last
  unit of stock via real `SELECT ... FOR UPDATE` row locking; exactly one succeeds.
- `tests/Feature/Catalog/CatalogCacheTest.php` — one test round-trips through real
  Redis instead of the array cache driver.

## External API

Passport is installed only for external `/api/v1` clients. Browser UI continues to
use session auth through the `web` guard.

```bash
composer require laravel/passport
php artisan vendor:publish --tag=passport-config
php artisan vendor:publish --tag=passport-migrations
php artisan migrate
php artisan passport:keys
php artisan passport:client --password --provider=users --name="StockFlow B2B Password Grant"
php artisan passport:client --client --name="StockFlow Integration"
```

Access tokens last 15 minutes; refresh tokens last 30 days and rotate on use. API
docs live at [`docs/api-v1.md`](../docs/api-v1.md). Routes are under `/api/v1` and
require `auth:api`, Passport scopes, Laratrust permissions/policies, JSON headers,
and rate limiting.

Password-grant tokens are for B2B users and are required for quote, PO, and payment
workflows because those routes need `User` policies and business-account ownership.
Client-credentials tokens are accepted as scoped service principals for read-only
catalog and stock availability endpoints.

## Building for production

```bash
make npm-build
# or: docker compose exec vite npm run build
```

## The stock engine

`app/Services/StockService.php` is the only place `stock_movements` /
`stock_levels` are ever written. Every mutation:

1. runs inside `DB::transaction()` — the Service owns the transaction boundary,
   never the Repository or Controller;
2. locks the affected `stock_levels` row(s) via `lockForUpdate()`
   (`StockRepository::lockOrCreateLevel()` — creates the row first if it doesn't
   exist yet, race-safe against a concurrent creator via a unique-constraint
   catch-and-relock fallback);
3. appends exactly one immutable `stock_movements` row (`transfer()` appends two: a
   paired `transfer_out` + `transfer_in`, both warehouse rows locked in a
   deterministic sorted-UUID order so opposite-direction concurrent transfers
   between the same two warehouses can't deadlock);
4. updates the `stock_levels` projection to match.

`available` (`on_hand - reserved`) is always computed, never stored. No operation
lets `on_hand` or `reserved` go negative, and `reserve()`/`transfer()` reject a
request once `available < quantity` — even under concurrency, because the row lock
serializes competing transactions onto the same up-to-date numbers.

`reconcile()` (and `php artisan stock:reconcile`) independently sums
`stock_movements.quantity` per (product, warehouse) — grouped by which movement
types affect `on_hand` vs. `reserved` — and compares it against the `stock_levels`
row. CI can run `php artisan stock:reconcile` and treat a non-zero exit code as a
ledger/projection drift.

Warehouse-scoped authorization: `StockPolicy` + `WarehouseScopeMiddleware` check
that the acting user's Laratrust team includes every warehouse a `stock.move` /
`stock.transfer` request touches (`app/Support/WarehouseAccess.php`); SuperAdmin
bypasses team scoping. See `docs/project/canonical-decisions.md` §3/§6 for the full
rationale.

## B2C checkout

`OrderService` state machine: `pending → reserved → confirmed → fulfilled`, or
`pending`/`reserved → cancelled`. Every stock mutation is delegated to
`StockService` (`reserve()`/`confirmSale()`/`release()`) — `OrderService` never
writes `stock_movements` itself.

`checkout()` prices every cart line from the active `b2c_retail` price list
(`CatalogService::retailPriceFor()`), picks a fulfillment warehouse
(`StockService::bestWarehouseFor()` — most-available-stock heuristic, not a
customer choice), and reserves every line inside one `DB::transaction()`. Any line
failing rolls back the whole checkout — no `Order`/`OrderItem` row is left behind.
VAT is a fixed 14%, computed with `bcmath` to avoid float rounding drift on money.
`orders.reserved_until` (30 minutes from checkout) is released by
`php artisan stock:release-expired-reservations`, scheduled every minute.

Payment methods (`app/Payments/*Gateway.php`, resolved by
`PaymentService::resolveGateway()`): `fake_gateway` is demo/test-only and uses the
same verified webhook path as real providers; `cod` stays pending until authorized
staff confirms cash collection; `paymob`/`fawry` are signed-webhook placeholders
with explicit TODOs for real provider contracts/credentials; `bank_transfer` is
staff-settled for B2B. `PaymentService` locks the payment row and marks it
`paid`/`failed` inside the same DB transaction that confirms the order or releases
the reservation, so duplicate callbacks are no-ops and cannot reduce stock twice.
Cart is session-backed (`CartService`) — not a DB table, since only *order
creation* is required to be database-backed.

## B2B procurement

Two linked state machines:

- **Quote** (`QuoteService`): `draft → sent → accepted | rejected | expired`.
  `request()` creates a `draft` quote from a Business Buyer's desired
  products/quantities — no prices yet. A Vendor (their own products only — "own
  pricing context") or Inventory Manager prices every line via `price()`, which
  moves the quote to `sent` with a 14-day expiry. The Business Buyer then
  `accept()`s or `reject()`s it.
- **Purchase Order** (`PurchaseOrderService`): `pending_approval → approved →
  fulfilled → closed`, or `pending_approval → rejected`.

`QuoteService::accept()` is never called from a controller directly — only
`PurchaseOrderService::createFromQuote()` calls it, inside the same
`DB::transaction()` that creates the `PurchaseOrder` and its `PoItem`s, so
"accept the quote" and "create the PO" always happen together or neither does.
**Creating the PO does not reserve stock** — it only picks a fulfillment warehouse
per line; reservation happens only when an approver calls `approve()`.

`approve()`:
1. locks the `business_accounts` row (`BusinessAccountRepository::lockForUpdate()`
   — so two concurrent approvals against the same account can't both pass against
   a stale balance);
2. checks `outstanding_balance + PO total <= credit_limit` (via `bccomp`, not
   float comparison) — throws `CreditLimitExceededException` if it would be
   exceeded, leaving the PO untouched (`pending_approval`, no stock reserved);
3. records a `po_approvals` row, reserves every line via `StockService::reserve()`,
   and adds the PO total to `outstanding_balance` (the buyer now owes it under net
   terms).

Bank Transfer settlement (`POST /procurement/purchase-orders/{po}/bank-transfer`)
initiates and settles a `bank_transfer` `Payment` through `PaymentService`.
`PaymentService::settleManually()` then runs the payment update and
`PurchaseOrderService::settle()` inside one transaction, converting every line's
reservation into a completed sale (`StockService::confirmSale()`) and paying down
`outstanding_balance`.

`QuotePolicy`/`PurchaseOrderPolicy` enforce "own account" (Business Buyer) / "own
pricing context" (Vendor) record-level scoping; staff holding `po.approve` or
`payment.settle` can see/act on any. `PaymentPolicy` branches on payable type
(`Order` for B2C, `PurchaseOrder` for B2B) since both share the polymorphic
`payments` table.

## Admin, audit, dashboard & reports

`AuditService::record()` is the only writer of `activity_log` (the same pattern as
`StockService` being the only writer of `stock_movements`) — called from inside
`StockService::adjust()`, `PurchaseOrderService::approve()`/`reject()`,
`PaymentService`'s settlement path (covers manual settlement, webhook confirmation,
and the Fake Gateway simulator uniformly, since all three funnel through the same
method), `RoleAssignmentService::syncRoles()`, and `RolePermissionService::
syncPermissions()` — never from a Controller directly, so an entry can't exist
without the action it describes having actually committed (both happen inside the
same `DB::transaction()`). Fixed event vocabulary: `stock.adjusted`, `po.approved`,
`po.rejected`, `payment.settled`, `user.roles_updated`, `role.permissions_updated`.
View/filter at `/admin/audit-log` (`audit.read`; filters: event, user, date range).

`RolePermissionService` lets a `role.manage` holder edit a role's own permission
set inline from `/admin/roles` (Laratrust's `Role::syncPermissions()` already
invalidates the permission cache for every user holding that role — no extra
cache-busting step needed). `/admin/users/{user}/roles` (page component
`Admin/Users/Edit`) still handles which roles a user has.

`DashboardService::kpisFor()` returns a small COUNT/SUM bundle — `low_stock_count`,
`pending_po_approvals`, `pending_payments`, `todays_sales_total`,
`recent_activity` for staff; `pending_po_approvals`, `credit_limit`,
`outstanding_balance` for a Business Buyer; `{scope: 'none'}` for anyone else
(a bare Retail Customer isn't shown store-wide numbers) — cached for 60 seconds per
viewer scope (staff share one cache entry; a Business Buyer gets one scoped to
their `business_account_id`). A short TTL, not CatalogService's tag-and-flush
pattern: dashboard reads don't vastly outnumber writes the way catalog reads do.

Five reports, each a paginated + filtered + indexed `ReportService` call:

| Report | Route | Permission | Filters |
| --- | --- | --- | --- |
| Low stock | `/reports/low-stock` | `stock.read` | product, warehouse, threshold |
| Stock movements | `/reports/stock-movements` | `stock.read` | product, warehouse, type, user, date range |
| Sales | `/reports/sales` | `payment.settle` | product, warehouse, status, user, date range |
| Payments | `/reports/payments` | `payment.settle` | status, method, user, date range |
| Import history | `/reports/imports` | `import.run\|audit.read` | status, entity, user, date range |

Not every report exposes all five filter dimensions (date range/product/warehouse/
status/user) — only the ones that actually exist on the underlying table. Payments
have no product/warehouse column, so "user" maps to the payment's payable owner
instead (`Order.user_id` or `PurchaseOrder.businessAccount.user_id`) and
product/warehouse are omitted. Import batches span many rows/entities rather than
one product, so `entity` stands in for "product". New indexes added for these
reports: `payments(status, created_at)` + `payments(method)`,
`import_batches(status, created_at)`, `activity_log(causer_id, created_at)` +
`activity_log(event)`; the Stock Movement report reuses the existing
`stock_movements(product_id, warehouse_id, created_at)` index, and Sales reuses
`orders(status, created_at)`.

## Excel imports

Installed package:

```bash
composer require maatwebsite/excel
```

The UI lives at `/imports` and requires `import.run` (seeded for SuperAdmin and
Inventory Manager). `make start` already runs the queue worker; without Docker,
`composer run dev` starts the queue listener alongside Laravel and Vite.

Supported entities and natural keys:

- `categories`: `slug` (or generated from `name`), optional `parent_slug`.
- `products`: `sku`, with `category_slug` or `category_name`.
- `warehouses`: `code`.
- `suppliers`: `email` when present, otherwise `name`.
- `price_lists`: `name` + `type` for the list, `sku` + `min_qty` for items.
- `opening_stock`: `sku` + `warehouse_code`; `quantity` is the target on-hand value.

Manual test flow:

1. Log in as a SuperAdmin or Inventory Manager.
2. Open `/imports/create`, select an entity, and upload `.xlsx`, `.xls`, `.csv`, or
   `.txt`.
3. Open the resulting batch page at `/imports/{batch}` and refresh until status is
   `Completed`.
4. If failures exist, open `/imports/{batch}/errors` or download the CSV report.
5. For `opening_stock`, run `php artisan stock:reconcile`; it should report no
   ledger/projection drift.

## Hardening

Full detail (cache keys/TTLs/invalidation triggers, index inventory, real
`EXPLAIN` plans) lives in [`docs/technical/cache.md`](docs/technical/cache.md)
and [`docs/technical/indexing.md`](docs/technical/indexing.md). Summary:

- **Caching**: `CatalogService` (tag `catalog`, flush-on-write) and
  `StockService::listLevels()` — the Stock/Levels report page only — (tag
  `stock-levels`, 30s TTL, flushed on every `recordMovement()` call). Every
  other stock read stays live/uncached deliberately: caching a locked-mutation
  decision or `reconcile()`'s ledger/projection proof would defeat the point of
  the ledger. `DashboardService::kpisFor()` uses a short 60s TTL cache instead
  of tag-and-flush, since dashboard reads don't vastly outnumber writes.
- **Laratrust permission cache**: self-invalidates on every `addRole()` /
  `removeRole()` / `syncRoles()` / `syncPermissions()` call — no manual
  cache-busting needed in application code. One real gotcha this pass fixed:
  `migrate:fresh` resets bigint auto-increment IDs but never touches Redis, so
  a stale permission-cache entry from a *previous* user with the same ID could
  survive a reset and get served to a freshly-seeded SuperAdmin.
  `DatabaseSeeder::run()` now flushes the cache before seeding; `make fresh`
  also runs `cache:clear` as a second layer of defense. Regression test:
  `tests/Feature/Admin/SeededSuperAdminAccessTest.php`.
- **Rate limiting** (`AppServiceProvider::boot()`): `login` (5/min, keyed by
  IP+email — so one attacker IP can't lock out a legitimate email, and one
  email being hammered from many IPs still throttles), `checkout` (10/min per
  authenticated user), `webhook` (60/min per IP, applied to the whole
  `/webhooks/v1` group), `api` (120/min per token/IP).
- **Queue / Horizon**: `QUEUE_CONNECTION=redis`. The `queue` Docker Compose
  service runs `php artisan horizon`, which supervises workers and exposes a
  dashboard at `/horizon` (throughput, retries, failed jobs) gated to
  SuperAdmin only (`HorizonServiceProvider::gate()`) — Horizon shows job
  payloads/failure details with no equivalent entry in the PRD permission
  matrix, so it's a direct role check rather than a new granular permission.
  `config/horizon.php`'s `defaults.tries`/`backoff` (3/3) preserve the retry
  behavior the previous plain `queue:work --tries=3 --backoff=3` process gave
  `ImportCatalogJob` (which declares no `$tries` of its own).
- **Scheduler**: `stock:release-expired-reservations` runs every minute
  (`routes/console.php`), releasing B2C checkout reservations whose
  `reserved_until` has passed. `scheduler` Docker Compose service loops
  `artisan schedule:run` every 60s.
- **Reconciliation**: `php artisan stock:reconcile` independently sums
  `stock_movements` per (product, warehouse) and diffs it against
  `stock_levels`; non-zero exit on drift, safe to run in CI/cron.
- **Security headers**: `App\Http\Middleware\SecurityHeaders`, registered
  globally, sets `X-Content-Type-Options: nosniff`, `X-Frame-Options: DENY`,
  `Referrer-Policy: strict-origin-when-cross-origin`,
  `Permissions-Policy: camera=(), microphone=(), geolocation=()` on every
  response, plus `Strict-Transport-Security` on HTTPS requests. No CSP yet —
  the React bundle has no nonce plumbing and a naive policy would break
  inline styles some UI libraries rely on; deliberately deferred.
- **Code quality gate**: `pint.json` (Laravel preset), `phpstan.neon` +
  `phpstan-baseline.neon` (Larastan level 5 — 250 pre-existing findings
  baselined, mostly a documented Larastan false-positive class around enum
  `casts()` methods, not real bugs). `make quality` runs pint + stan + the
  full test suite locally; `.github/workflows/ci.yml` runs the same three
  gates on every push/PR against real MySQL + Redis service containers (only
  a handful of tests need them — see `tests/Concerns/UsesRealMysqlDatabase.php`
  — the rest of the suite runs on SQLite in-memory).

### Final hardening checklist

- [x] Redis caching — catalog (pre-existing) + stock levels report (new)
- [x] Cache invalidation — flush-on-write for both, documented in `docs/technical/cache.md`
- [x] Laratrust permission cache — self-invalidating; stale-cache-after-reset bug fixed + regression-tested
- [x] MySQL indexes — inventoried with real `EXPLAIN` plans in `docs/technical/indexing.md`
- [x] EXPLAIN validation notes — 8 real query plans captured against dev MySQL
- [x] Rate limiting — login, checkout, payment webhook, `/api/v1` (pre-existing)
- [x] Scheduler — `stock:release-expired-reservations` every minute (pre-existing, re-verified)
- [x] Queue workers — `queue:work` replaced by Horizon-supervised workers
- [x] Reconciliation — `stock:reconcile` (pre-existing, re-verified: 0 drift)
- [x] CI quality gates — GitHub Actions: pint, stan, full test suite
- [x] Test coverage — added: `SeededSuperAdminAccessTest`, `StockLevelCacheTest` (×2), `CatalogCacheTest` product-update case, `RateLimitingTest` (×4), `HorizonAccessTest` (×3), `SecurityHeadersTest`
- [x] Security headers — `SecurityHeaders` middleware, global
- [x] Laravel Pint — `pint.json`, clean across 299 files
- [x] PHPStan/Larastan — level 5, baseline generated, 2 real issues fixed (`StockLevel` model docblocks)
- [x] SuperAdmin unauthorized-access bug — fixed at the root cause (seeder cache flush), not just cleared once

Verification commands run before considering this pass complete:
`php artisan test` (159 passed), `./vendor/bin/pint --test` (299 files, clean),
`./vendor/bin/phpstan analyse` (no errors against baseline), `npm run build`
(clean production build).

## Project structure notes

- `routes/web.php` — Inertia page routes only (session/`web` guard). No API routes.
- `routes/api.php` — external Passport B2B API only, mounted as `/api/v1`.
- `routes/webhooks.php` — `/webhooks/v1/paymob`, `/webhooks/v1/fawry`, and
  `/webhooks/v1/fake-gateway`; mounted without the web/session/CSRF stack and
  signature-verified where the provider supports it.
- `app/Http/Controllers/Web/` — Inertia controllers, one folder per module
  (`Auth/`, `Admin/`, `Catalog/`, `Stock/`, `Sales/`, `Procurement/`, `Import/`,
  `Reports/`).
- `app/Http/Controllers/Api/V1/` — JSON API controllers for external B2B/system
  clients; thin wrappers around the same Services used by Web controllers.
- `app/Http/Controllers/Webhooks/` — Paymob/Fawry/Fake Gateway webhook endpoints.
- Layering: **Controller → FormRequest → Service → Repository → Model.** Controllers
  never call Eloquent directly; FormRequests own `authorize()`/`rules()`; Services
  own business rules/transactions; Repositories own Eloquent queries; Policies own
  record-level authorization.
- `resources/js/Pages/` — Inertia pages, resolved by `resources/js/app.jsx`, one
  folder per module (`Auth/`, `Admin/`, `Catalog/`, `Stock/`, `Sales/`,
  `Procurement/`, `Import/`, `Reports/`).
- `resources/js/Layouts/` — `AppLayout` (authenticated shell, renders
  `FlashMessage`) and `GuestLayout` (centered card, used by the login page).
- `resources/js/Components/` — shared UI primitives: `Button`, `Input`, `Select`,
  `Table`, `Pagination`, `Breadcrumbs`, `FlashMessage`, `PermissionGate`.
- `app/Http/Middleware/HandleInertiaRequests.php` — shares `auth.user`,
  `auth.roles`, `auth.permissions`, and `flash.success`/`flash.error` on every
  Inertia response.
- `app/Console/Commands/` — `stock:reconcile` and
  `stock:release-expired-reservations` (both fully implemented and scheduled).

## Permissions (Laratrust)

Seeded by `RolePermissionSeeder` per the Enterprise PRD §3 permission matrix:
`catalog.read`, `product.manage`, `category.manage`, `warehouse.manage`,
`stock.read`, `stock.move`, `stock.transfer`, `import.run`, `pricelist.manage`,
`sale.create`, `quote.request`, `quote.price`, `po.approve`, `payment.settle`,
`user.manage`, `role.manage`, `audit.read`.

## Not yet built

- Real Paymob/Fawry API calls, credentials, and provider-specific signature
  canonicalization. Placeholder drivers reject unsigned callbacks and document the
  TODOs.
