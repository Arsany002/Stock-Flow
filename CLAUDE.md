# StockFlow

B2B/B2C e-commerce & inventory platform. Laravel 12 + Inertia.js + React, one app.
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

- One Laravel 12 app. Inertia + React. No Next.js, no separate SPA, no React Router.
- Human UI: session auth (`web` guard) only. No Passport token ever touches the
  browser for human sessions.
- Laravel Passport: external B2B API only, under `/api/v1`, namespaced
  `App\Http\Controllers\Api\V1`.
- Payment webhooks: `/webhooks/v1`, CSRF-exempt, signature-verified, idempotent.
- Layering: Controller → Service → Repository → Model. Controllers never call
  Eloquent directly. Web and API controllers call the same Services.
- Stock mutations: `DB::transaction()` + `lockForUpdate()`, no oversell under
  concurrency, `stock:reconcile` proves ledger == `stock_levels`.

## Roles

SuperAdmin, Inventory Manager, Sales/Cashier, Vendor/Supplier, Business Buyer, Retail
Customer — enforced with Laratrust; warehouse-scoped roles use Laratrust teams (one
team per warehouse).
