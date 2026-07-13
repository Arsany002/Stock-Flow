# Adaptive rate limiting

This sits on top of (not instead of) the existing named `throttle:*` limiters
registered in `AppServiceProvider::boot()` (`login`, `checkout`, `cart`,
`webhook`, `api`) — those are hard per-minute caps. `AdaptiveThrottleService`
adds a graduated **slow-down zone** before a hard block, and remembers a block
independently of the underlying named limiter's own decay window.

## Profiles

Configured in `config/abac.php` under `throttle_profiles`. Each profile has:

| Key | Meaning |
|---|---|
| `window` | Seconds the hit counter accumulates over before resetting. |
| `slow_after` | Hit count beyond which an artificial delay is added (request still succeeds). |
| `block_after` | Hit count beyond which the caller is hard-blocked (429). |
| `block_for` | Seconds a block lasts once triggered. |
| `delay_ms` | Artificial delay applied once `slow_after` is crossed — skipped entirely when `app()->environment('testing')`. |

Defaults (`config/abac.php`):

| Profile | window | slow_after | block_after | block_for | delay_ms |
|---|---|---|---|---|---|
| `public_read` | 60s | 120 | 240 | 5m | 250 |
| `cart_mutation` | 60s | 20 | 40 | 10m | 500 |
| `auth` | 60s | 5 | 10 | 15m | 1000 |
| `checkout` | 60s | 10 | 20 | 15m | 750 |
| `payment` | 60s | 20 | 40 | 15m | 500 |
| `stock` | 60s | 30 | 60 | 15m | 500 |
| `admin` | 60s | 40 | 80 | 15m | 500 |
| `api` | 60s | 60 | 120 | 15m | 250 |

## Which routes use which profile

See `routes/web.php`, `routes/api.php`, and `routes/webhooks.php` for the
exact `adaptive.throttle:{profile},{action}` middleware on each route group:

- `public_read` — storefront browsing (`/products`, `/search`,
  `/categories/*`). Deliberately generous; never paired with `abac`.
- `cart_mutation` — `/cart/items` add/update/remove, `/cart` clear.
- `auth` — `/login`, `/register`.
- `checkout` — `/checkout` (create + store).
- `payment` — `/payments/{payment}/settle`, and (separately) every
  `/webhooks/v1/*` route via the `webhook.payment` action.
- `stock` — stock adjustment/transfer store routes.
- `admin` — everything under `/admin/*`, plus PO approval and Excel import
  (chosen deliberately stricter/coarser than a dedicated profile for those
  two, since they're comparatively rare, high-impact actions).
- `api` — every `/api/v1/*` route (split into `api.v1.read` /
  `api.v1.write` actions so GET traffic and mutating traffic are counted
  separately even under the same profile).

## Redis keys

`AdaptiveThrottleService::key()` builds:

```
abac_throttle:{profile}:{action}:{routeName}:{identity}
```

`identity` is the authenticated user's ID, or `ip:{request IP}` for guests —
so one guest hammering `/cart/items` never throttles a different guest, and
logging in mid-session doesn't reset a guest's remaining quota. The hit
counter itself is stored via Illuminate's `RateLimiter` (Cache-backed — Redis
in production, the array driver in tests); the hard-block flag is a separate
`{key}:blocked` Cache entry with its own TTL (`block_for`), so a block
survives even after the hit-counter's own `window` has decayed.

## Slowdown vs. block

- Under `slow_after`: request proceeds immediately, no side effects.
- Between `slow_after` and `block_after`: request still succeeds, but
  `usleep($delay_ms * 1000)` runs first (skipped in the `testing`
  environment — assert on the `AccessDecision`'s `meta['slowed']` flag
  instead of wall-clock time). This is a soft anti-automation measure, not a
  security boundary.
- Beyond `block_after`: the request is rejected with **429** and the message
  `"Too many requests. Please try again later."` — JSON for `/api/*`
  requests, an Inertia flash-redirect for web requests. The block itself is
  also recorded to `activity_log` as `security.rate_limit_blocked` via
  `AuditService`, visible at `/admin/audit-log`.

SuperAdmin does **not** bypass rate limiting by default —
`config('abac.super_admin_bypass_rate_limiting')` defaults to `false`. This is
deliberate: abuse protection is not a permission, and must not be silently
bypassable just by holding the highest role.

## Tuning thresholds

Edit `config/abac.php`'s `throttle_profiles` array (or set matching
`ABAC_*` env vars if you promote specific values to `.env` — none are wired
to env vars out of the box besides the two SuperAdmin-bypass flags, since
per-profile tuning is expected to be a deploy-time config change, not a
runtime secret). No migration or cache flush is needed — the config is read
fresh on every request via `config("abac.throttle_profiles.{$profile}")`.
