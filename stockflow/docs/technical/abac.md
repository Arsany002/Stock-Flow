# ABAC (attribute-based access control)

## RBAC vs ABAC

Laratrust (RBAC) answers **"does this user have this permission at all?"** —
`$user->isAbleTo('stock.move')`, checked by the `permission:*` route middleware
and inside FormRequests/Policies for record-level scoping. That answer never
changes based on the clock.

ABAC answers a narrower, time-dependent question: **"can this user perform
this action *right now*, from this request?"**. It runs *after* Laratrust has
already said yes, and can only take away access, never grant it. AbacService
(`app/Services/AbacService.php`) is the single entry point; `EnsureAbacAllowed`
(`abac:{action},{permission}` middleware) is the only thing that calls it.

Rate/abuse protection is a third, orthogonal concern — "is this user/IP
hitting this action too aggressively?" — handled entirely by
`AdaptiveThrottleService` / `AdaptiveThrottle` middleware
(`adaptive.throttle:{profile},{action}`). See
[rate-limiting.md](rate-limiting.md). ABAC and adaptive throttling never call
each other and can be reasoned about independently.

## What request attributes are checked

`AccessContext` (`app/Support/Access/AccessContext.php`) is built once per
request by `EnsureAbacAllowed` via `AccessContext::fromRequest()`: the acting
user (nullable), IP, route name, the fixed `action` name (see
`App\Support\Access\AccessAction`), the `permission` being exercised (if any),
the current time (in `config('abac.timezone')`, default `Africa/Cairo`), the
request method/path, and whether the request is `web`/`api`/`guest`.

## How working hours are enforced

Two tables, checked in this order by `AccessWindowService`:

1. **`permission_access_windows`** — a stricter, permission/action-specific
   schedule. If any *active* row exists for the permission (+ optionally a
   specific `action`), it fully overrides the company schedule for that
   permission/action — even if it's *more* permissive (e.g. `checkout.confirm`
   is open until 23:00, later than the company's normal 18:00 close).
2. **`company_working_hours`** — the global fallback, one row per
   `day_of_week` (0=Sunday..6=Saturday, PHP/Carbon convention). Used whenever
   step 1 finds no rows at all for that permission/action.
3. If **neither** table has a row (no company row for that weekday, and no
   permission window), the action is **allowed by default** — absence of
   configuration is permissive, not restrictive, so a fresh install with an
   empty schedule never accidentally locks everyone out.

Both tables support overnight ranges (`starts_at`/`opens_at` >
`ends_at`/`closes_at`, e.g. `22:00 -> 06:00`) via
`AccessWindowService::isTimeInsideWindow()` and the day-crossing logic in
`isPermissionAllowedNow()` (a window keyed to Saturday also covers the
post-midnight portion on Sunday).

## Permission windows and roles

A `permission_access_windows` row can optionally be scoped to one
`role_id` (nullable — `null` means "applies to anyone holding this
permission, regardless of role"). Multiple rows for the same permission are
expected (one per applicable day); `AbacService` allows the request if *any*
matching row covers the current moment.

## SuperAdmin bypass rules

Two independent, separately-configurable bypasses:

- **Time windows**: `config('abac.super_admin_bypass_time_windows')` (default
  `true`) lets a SuperAdmin skip `company_working_hours` entirely. For
  `permission_access_windows`, the bypass is *per-row*
  (`bypass_for_super_admin`, default `true`) — an admin can deliberately
  create a stricter window that even a SuperAdmin can't bypass by setting
  that column to `false`.
- **Rate limiting**: `config('abac.super_admin_bypass_rate_limiting')`
  (default **`false`**) is separate and off by default — holding the highest
  role must never be a silent abuse-protection bypass. AdaptiveThrottleService
  does not currently branch on this flag at all (it's reserved for an
  explicit opt-in if a future incident ever requires it); the default
  behavior is that **no one**, including SuperAdmin, bypasses adaptive
  throttling.

## Why webhooks are excluded from working-hour checks

Payment providers (Paymob, Fawry) and the Fake Gateway simulator call
`/webhooks/v1/*` whenever a transaction settles on *their* schedule, not
StockFlow's business hours. `routes/webhooks.php` therefore applies
`adaptive.throttle:payment,webhook.payment` (abuse protection) but never
`abac:*` — the real security boundary for that route group is signature
verification and `payments.gateway_ref` idempotency inside
`PaymentService::verifyWebhook()`, which stays completely unaffected by the
clock.

## Adding a new ABAC-checked action

1. Add a constant to `App\Support\Access\AccessAction`.
2. Apply `abac:{action}` or `abac:{action},{permission}` to the route.
3. Optionally seed `permission_access_windows` rows for that
   permission/action, or let it fall back to `company_working_hours`.
4. Manage schedules going forward via `/admin/access/company-hours` and
   `/admin/access/permission-windows` (gated by the `access.manage`
   permission — SuperAdmin only by default).
