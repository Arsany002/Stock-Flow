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
  `App\Http\Controllers\Api\V1`. Not installed yet.
- Payment webhooks: `/webhooks/v1`, CSRF-exempt, signature-verified, idempotent. Not
  built yet.
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

- **Local dev infra**: Docker Compose (`app`, `mysql`, `redis`, `queue`, `scheduler`,
  `vite` services). `make start` / `make test` / `make migrate` etc. — see
  `stockflow/Makefile` and `stockflow/README.md`.
- **Auth**: session login/logout (`Web/Auth/LoginController`, `AuthService`).
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
  `OrderService`, `PaymentService`, `QuoteService`, and `PurchaseOrderService` have
  real logic; only `ImportService` is still a skeleton (methods throw
  `LogicException` — not implemented yet).
- **Catalog module** (first full business module, the template for future ones):
  products/categories/suppliers/price-lists CRUD, Redis-cached reads (tag `catalog`,
  flushed on every write), vendor-scoped price-list-item ownership.
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
  resolved by `PaymentService::resolveGateway()`): `cod` and `fake` are fully
  wired (`fake` resolves synchronously at checkout via `$options['outcome']` —
  demo/test only, no real gateway); `paymob`/`fawry` are placeholders
  (`PaymentMethod::isPlaceholder()`) that leave the payment `pending` for manual
  settlement rather than throwing. Staff (`payment.settle`) settle a pending
  payment via `POST /payments/{payment}/settle` →
  `PaymentService::settleManually()` + `OrderService::confirmPayment()`. Real
  Paymob/Fawry integration (webhook signature verification under
  `/webhooks/v1`) is still future work — `PaymentService::verifyWebhook()`
  throws. Web UI at `/cart`, `/checkout`, `/orders`, `/orders/{order}`,
  `/payments/{payment}`, gated by `sale.create` (checkout) and
  `OrderPolicy`/`PaymentPolicy` (record-level: a customer sees only their own
  orders/payments; staff holding `payment.settle` can see and settle any).
  Cart is session-backed (`CartService`, `[product_id => quantity]` in the
  Laravel session) — deliberately not a DB table, since requirement #1 only
  requires *order creation* to be database-backed, and prices are always looked
  up fresh rather than cached in the session.
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
  `PaymentService::initiate()` + `settleManually()` (reusing the B2C module's
  `ManualSettlementGateway`) then `PurchaseOrderService::settle()`, which converts
  every line's reservation to a sale via `StockService::confirmSale()` and pays
  down `outstanding_balance` — mirrors B2C `confirmPayment()`, but also touches
  the credit ledger. Web UI at `/procurement/quotes/*` and
  `/procurement/purchase-orders/*`, gated by `quote.request` (Business Buyer),
  `quote.price` (Vendor/Inventory Manager), `po.approve`, `payment.settle`, with
  `QuotePolicy`/`PurchaseOrderPolicy` doing "own account" / "own pricing context"
  record-level scoping (staff holding `po.approve`/`payment.settle` can see/act on
  any). `PaymentPolicy` now branches on payable type (`Order` for B2C,
  `PurchaseOrder` for B2B) since both share the polymorphic `payments` table.

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
  `ALTER TABLE ... MODIFY ... ENUM(...)`.** Adding `PaymentMethod::Fake` required
  widening `payments.method`'s enum values after the fact. Raw SQL (`DB::statement`)
  is MySQL-only syntax and breaks the test suite's default SQLite `:memory:`
  connection outright (no `ENUM` type, no `MODIFY COLUMN`). `Schema::table(...,
  fn ($table) => $table->enum('method', [...])->change())` works on both — see
  `database/migrations/2026_07_07_222923_add_fake_to_payments_method_enum.php`.
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
