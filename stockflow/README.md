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
- Not yet built: B2C checkout, B2B quote/PO workflow, Excel import, payments,
  Laravel Passport (`/api/v1`), payment webhooks.

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
`shell`, `migrate`, `fresh`, `test`, `npm-dev`, `npm-build`).

Visit `http://127.0.0.1:8000`. Guests are redirected to `/login`; authenticated users
land on `/dashboard`. `DemoUserSeeder` creates a SuperAdmin login (`RolePermissionSeeder`
must run first — `db:seed` runs seeders in order, so a plain `db:seed` is enough).

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

## Project structure notes

- `routes/web.php` — Inertia page routes only (session/`web` guard). No API routes.
- `app/Http/Controllers/Web/` — Inertia controllers, one folder per module
  (`Auth/`, `Admin/`, `Catalog/`, `Stock/`). Future API controllers will live under
  `app/Http/Controllers/Api/V1/` and payment webhooks under a `Webhooks/` group —
  neither exists yet.
- Layering: **Controller → FormRequest → Service → Repository → Model.** Controllers
  never call Eloquent directly; FormRequests own `authorize()`/`rules()`; Services
  own business rules/transactions; Repositories own Eloquent queries; Policies own
  record-level authorization.
- `resources/js/Pages/` — Inertia pages, resolved by `resources/js/app.jsx`, one
  folder per module (`Auth/`, `Admin/`, `Catalog/`, `Stock/`).
- `resources/js/Layouts/` — `AppLayout` (authenticated shell, renders
  `FlashMessage`) and `GuestLayout` (centered card, used by the login page).
- `resources/js/Components/` — shared UI primitives: `Button`, `Input`, `Select`,
  `Table`, `Pagination`, `Breadcrumbs`, `FlashMessage`, `PermissionGate`.
- `app/Http/Middleware/HandleInertiaRequests.php` — shares `auth.user`,
  `auth.roles`, `auth.permissions`, and `flash.success`/`flash.error` on every
  Inertia response.
- `app/Console/Commands/` — `stock:reconcile` (implemented),
  `stock:release-expired-reservations` (skeleton — no reservation-expiry concept
  exists in the schema yet).

## Permissions (Laratrust)

Seeded by `RolePermissionSeeder` per the Enterprise PRD §3 permission matrix:
`catalog.read`, `product.manage`, `category.manage`, `warehouse.manage`,
`stock.read`, `stock.move`, `stock.transfer`, `import.run`, `pricelist.manage`,
`sale.create`, `quote.request`, `quote.price`, `po.approve`, `payment.settle`,
`user.manage`, `role.manage`, `audit.read`.

## Not yet built

- Laravel Passport (external B2B API under `/api/v1`).
- Payment webhooks (`/webhooks/v1`).
- B2C checkout, B2B quote/PO workflow, Excel import, payments.
- `stock:release-expired-reservations` (skeleton only — needs a reservation-expiry
  concept added to the schema first).
