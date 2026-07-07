# StockFlow — Canonical Decisions

This document is the single arbitration reference for the StockFlow rebuild. When any
source document conflicts with another, or with an implementation detail, this file wins.
It exists because three source documents were produced at different times and disagree
on scope, tech stack, and terminology (see "Conflicts resolved" below).

## 1. Source-of-truth document order

When documents disagree, resolve in this order (highest precedence first):

1. **`docs/source/StockFlow-Enterprise-PRD.md.pdf`** — the Enterprise PRD (v2.0,
   "Approved for implementation"). This is authoritative for schema, architecture,
   security, workflows, and delivery plan.
2. **`docs/source/USER_STORIES.md.pdf`** — authoritative for acceptance criteria detail
   and behavior at the story level, as long as it does not contradict the Enterprise PRD.
3. **`docs/source/PRD.md.pdf`** — the earlier draft PRD (v1.0, "Draft for review",
   API-first framing). Treated as **historical background only**. Where it conflicts
   with the Enterprise PRD, the Enterprise PRD wins (see conflicts below).
4. **`docs/source/erd.png`** — visual schema reference. Useful for a quick relational
   overview, but the written table definitions in Section 6 of the Enterprise PRD are
   authoritative for column names, types, and constraints if a discrepancy is spotted.

### Conflicts resolved

- **Frontend**: v1.0 PRD implies API-first with an optional thin admin UI. Enterprise
  PRD confirms Laravel 12 + Inertia + React as the one and only human frontend.
  **Decision: Inertia + React, not API-first for humans.**
- **Auth for human UI**: v1.0 PRD implies Passport password grant for "first-party
  web/mobile clients." Enterprise PRD confirms session (`web` guard) for all human UI,
  Passport reserved for the external B2B API only. **Decision: session auth for humans,
  Passport only for `/api/v1`.**
- **Vendor drop-shipping**: both agree stock always routes through owned warehouses in
  v1 — no drop-ship, no vendor-direct fulfillment.
- **VAT**: flat 14% on all taxable lines (not per-category).
- **Credit limit**: configurable per `business_accounts` row (`credit_limit` +
  `net_terms_days`), not a fixed global constant.

## 2. Architecture decision

- **One Laravel 12 application.** Inertia.js + React rendered by the same app.
- **No Next.js. No standalone React SPA. No React Router.** Inertia owns client-side
  page routing via Laravel's router; there is no second frontend routing layer.
- Layering is enforced end to end: **Controller → Service → Repository → Model.**
  Controllers never touch Eloquent directly. Services own `DB::transaction()` and all
  business rules. Repositories own queries.
- Web controllers and API controllers are thin and symmetric: they call the **same
  Services**; they differ only in their return statement (`Inertia::render()` vs. a
  JSON API Resource).

## 3. Auth decision

- **Human UI (all six roles): session auth via the `web` guard.** Login via
  `Auth::attempt()`, cookie-based session (`HttpOnly`, `SameSite=Lax`, `Secure` in
  prod). Google OAuth (Socialite, stateless) also establishes a session — no browser
  token, no code-exchange step for a SPA.
- **No Passport token is ever stored in or read from the browser for human UI.**
- **Laravel Passport is scoped exclusively to the external B2B API** under `/api/v1`,
  guarded by `auth:api`. Grants: password grant + rotating refresh (external B2B
  system users), client-credentials (service-to-service integration). Access TTL 15
  min, refresh TTL 30 days, refresh rotates on use.
- Authorization (both guards) is enforced by **Laratrust** roles/permissions, with
  warehouse-scoping via Laratrust teams (one team per warehouse) and record-level
  Policies for Business Buyer / Vendor ownership (own quotes, POs, price lists).
  Permission checks are cached in Redis and invalidated on role/permission change.

## 4. Route decision

- **`routes/web.php`** — Inertia page routes, `web` guard, session auth,
  role/permission middleware. This is 100% of the human-facing surface (all six
  roles: SuperAdmin, Inventory Manager, Sales/Cashier, Vendor, Business Buyer, Retail).
- **`routes/api.php`** — external B2B API only, mounted under **`/api/v1`**,
  `auth:api` (Passport) + Laratrust permission + Passport scope
  (`catalog:read`, `orders:write`, `stock:read`, etc.). Returns `{data, meta}` JSON
  Resources.
- **Payment webhooks live under `/webhooks/v1`** (e.g. `/webhooks/v1/paymob`,
  `/webhooks/v1/fawry`) — a distinct route group from both `web.php` and the B2B
  `/api/v1`. Webhook routes are **CSRF-exempt but signature-verified**, and
  idempotent (deduped by `payments.gateway_ref`, unique constraint).
- No route serves both a session-authenticated human and a Passport-token client at
  the same URI.

## 5. Folder decision

Single Laravel project. Key structure (see Enterprise PRD §7 for the full tree):

```
app/
  Enums/                 # UserRole, MovementType, OrderStatus, PoStatus, QuoteStatus, ...
  Exceptions/            # OutOfStockException, PoNotApprovableException, ...
  Http/
    Controllers/
      Web/               # Inertia::render(...) — human UI, mirrors role groups
      Api/V1/            # JSON API Resources — Passport B2B, versioned
      Webhooks/          # Paymob, Fawry — CSRF-exempt, signature-verified
    Middleware/
    Requests/            # FormRequest per action (authorize() + rules())
    Resources/            # API Resources (JSON API + Inertia props)
  Jobs/                  # ImportCatalogJob, ReleaseExpiredReservations
  Models/
  Notifications/
  Payments/              # PaymentGateway interface + Paymob, Fawry drivers
  Policies/
  Providers/
  Repositories/          # Eloquent query layer
  Services/              # Business logic + transactions (StockService, OrderService, ...)
resources/js/             # Inertia root, Layouts, Components, Pages (mirrors controller groups)
routes/
  web.php                # Inertia pages
  api.php                # /api/v1 — Passport B2B API
  webhooks.php           # /webhooks/v1 — payment webhooks (or a dedicated group in web.php with CSRF exemption)
```

- `Api/` controllers are namespaced **`Api/V1`** from day one (not a bare `Api/`) to
  make the `/api/v1` versioning decision (Section 6) structural, not just a route
  prefix.

## 6. Stock decision

- **Stock is an immutable, insert-only ledger**: `stock_movements`. Every change
  (`purchase_in`, `sale_out`, `reservation`, `release`, `adjustment`, `transfer_in`,
  `transfer_out`) is a new row. Rows are never updated or deleted.
- **`stock_levels` is a denormalized projection**, not the source of truth: it caches
  `on_hand` / `reserved` per `(product_id, warehouse_id)` for O(1) reads and is always
  rebuildable from the ledger. `available = on_hand - reserved` (computed, not stored).
- **Invariant, CI-checked**: `SUM(stock_movements.quantity)` per `(product,
  warehouse)` must equal `stock_levels`. A `stock:reconcile` Artisan command proves
  this.
- **All stock mutations run inside `DB::transaction()` + `lockForUpdate()`** on the
  affected `stock_levels` row. No oversell under concurrency is a hard requirement,
  proven by a feature test against MySQL (row locks — not SQLite).
- **All inventory routes through owned warehouses.** `purchase_in` always targets an
  internal warehouse; there is no vendor drop-ship path in v1.
- Warehouse transfers are **paired and atomic**: one transaction emits both
  `transfer_out` and `transfer_in`, or neither commits.
- Expired unpaid reservations are released by a scheduled job (`release` movement).

## 7. API versioning decision

- The external B2B API is versioned from the first line of code: **`/api/v1`**, both
  in the route prefix and in the controller namespace (`App\Http\Controllers\Api\V1`).
- Payment webhooks are versioned independently under **`/webhooks/v1`** — they are not
  part of `/api/v1` and are not Passport-guarded (signature verification replaces
  bearer-token auth for these routes).
- A future `/api/v2` (or `/webhooks/v2`) must be additive — introduced as a parallel
  namespace/prefix, not a breaking rewrite of v1, unless a major version deprecation is
  explicitly planned and communicated.

## 8. Deprecated ideas — do not follow

The following appeared in one or more source documents but are explicitly **not**
part of this build. Do not reintroduce them without a new decision recorded in this
file:

- ❌ Next.js, or any second frontend framework/build alongside Inertia+React.
- ❌ A standalone React SPA consuming a JSON API for the human UI (the v1.0 draft
  PRD's "API-first, thin admin UI optional" framing). The Enterprise PRD supersedes
  this — Inertia is the human UI, full stop.
- ❌ React Router or any client-side router other than Inertia's own page visits.
- ❌ Passport tokens stored in browser storage (localStorage/sessionStorage/cookies
  read by JS) for human sessions.
- ❌ Vendor drop-shipping / stock bypassing owned warehouses.
- ❌ Multi-currency, shipping/courier integration, automated returns/RMA,
  promotions/coupons engine, multi-language UI — all explicitly out of scope for v1
  per both PRDs.
- ❌ A mutable `stock` counter column anywhere as the primary record of inventory —
  the ledger is always the source of truth; `stock_levels` is a cache, never treated
  as authoritative.
- ❌ Per-category VAT rates — flat 14% only in v1.
- ❌ Copying folder structure, patterns, or code from the old CMS project
  (`../CMS`). StockFlow is a new project; nothing is inherited from CMS.
