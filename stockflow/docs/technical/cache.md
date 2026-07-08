# Cache keys and invalidation

StockFlow uses Redis (`CACHE_STORE=redis`, tag-capable) for three independent caches.
Each has its own tag, its own TTL, and its own invalidation trigger — they never share
a tag, so flushing one never affects another.

| Tag | Owner | TTL | Invalidation |
| --- | --- | --- | --- |
| `catalog` | `CatalogService` | 3600s (1h) | Flushed on **every** catalog write (product/category/supplier/price-list create/update/delete) |
| `stock-levels` | `StockService` | 30s | Flushed on **every** stock movement (any of `purchaseIn`/`reserve`/`release`/`confirmSale`/`transfer`/`adjust`) |
| — (Laratrust internal) | Laratrust package | package default (1 day) | Flushed automatically by Laratrust on role/permission assignment changes |
| `dashboard:kpis:*` | `DashboardService` | 60s | Time-based only — no write-triggered flush (see below) |

## `catalog` — CatalogService

**Keys**: `catalog:{entity}:{md5(json_encode($parts))}`, e.g.
`catalog:products:<hash of [page, perPage, filters]>`, `catalog:categories:flat`,
`catalog:retail_price:<hash of [productId, quantity]>`.

**Read side** (`app/Services/CatalogService.php`): every list/lookup method wraps its
repository call in `Cache::tags(['catalog'])->remember($key, 3600, ...)`.

**Write side**: every mutating method (`createProduct`, `updateProduct`,
`deleteProduct`, `createCategory`, `deleteCategory`, `createSupplier`,
`deleteSupplier`, `createPriceList`, `createPriceListItem`, `updatePriceListItem`,
`deletePriceListItem`) calls `Cache::tags(['catalog'])->flush()` immediately after
the write, inside the same method (not deferred, not queued).

**Why flush-the-whole-tag instead of busting individual keys**: products, categories,
and price lists all influence each other's listings (a category rename changes what
shows in the product filter dropdown, a new price list item changes
`retailPriceFor()`'s result for that product, etc.). Cache keys are also
paginated/filtered (page number + arbitrary filter combinations are part of the key),
so there's no small, enumerable set of keys to bust individually — a full tag flush is
both simpler and correct. Given `catalog.read` traffic vastly outnumbers
`product.manage`/`category.manage`/`pricelist.manage` writes, this trade is cheap.

**Tested by**: `tests/Feature/Catalog/CatalogCacheTest.php` — cache invalidates on
product create, product update, category create, price-list create, and a dedicated
test that round-trips through *real* Redis (not the test suite's default `array`
driver) to catch serialization bugs the array driver can't.

## `stock-levels` — StockService::listLevels()

**Keys**: `stock:levels:{md5(json_encode([page, perPage, filters]))}`.

**Read side**: only `StockService::listLevels()` (the Stock/Levels report page) is
cached. TTL is deliberately short (30s, vs. catalog's 1h) — flush-on-write is the
primary invalidation mechanism; the TTL is just a backstop against a future write path
that forgets to flush.

**Write side**: `StockService::recordMovement()` — the single private method every
mutating method (`purchaseIn`, `reserve`, `release`, `confirmSale`, `transfer`,
`adjust`) funnels through to append a `stock_movements` row — calls
`Cache::tags(['stock-levels'])->flush()` right after the insert. Because every
mutation goes through this one choke point, there's no per-method flush call to
forget to add when a new mutation type is introduced.

**What is *never* cached, and why** — this is the "carefully" in "cached carefully":

- `findLevel()`, `lockLevelForUpdate()`, `lockOrCreateLevel()` — these back every
  stock mutation's row lock. Caching a value that's about to be checked against a
  `lockForUpdate()`'d row would defeat the whole no-oversell guarantee; the lock
  itself already serializes concurrent access, so there's nothing to gain from
  caching and everything to lose from staleness.
- `bestWarehouseFor()` (via `levelsForProductOrderedByAvailability()`) — a
  B2C/B2B fulfillment *placement heuristic*. It's cheap (single indexed query) and
  feeds directly into which warehouse gets a reservation attempt; a stale result
  could pick an already-empty warehouse. `reserve()` re-validates under lock
  regardless, so this wouldn't cause an oversell, but it would produce confusing
  "picked the wrong warehouse" behavior for no real performance benefit.
- `reconcile()`'s `allLevels()`/`ledgerTotals()` — reconciliation exists specifically
  to *prove* `stock_levels` matches the ledger. Caching either side of that proof
  would make `stock:reconcile` capable of reporting a false pass.

**Tested by**: `tests/Feature/Stock/StockLevelCacheTest.php` — cache invalidates
after a plain movement (`purchaseIn`) and after an adjustment
(`POST /stock/adjustments`).

## Laratrust permission cache

Laratrust (the roles/permissions package) maintains its own Redis-backed cache,
independent of the two above, keyed per-user (`laratrust_roles_for_users_{id}`) and
per-role. It self-invalidates on every mutation of the underlying pivot data —
`User::addRole()`/`removeRole()`/`syncRoles()` and `Role::addPermission()`/
`removePermission()`/`syncPermissions()` all call `flushCache()` internally as part
of the same method call, before returning. `RoleAssignmentService::syncRoles()` and
`RolePermissionService::syncPermissions()` (this app's own wrappers, which also
record an audit-log entry) don't need to do anything extra — the flush already
happened by the time those methods return.

**Tested by**:
`tests/Feature/Admin/AuthorizationTest.php::test_permission_cache_flushes_after_role_change`
(user role assignment) and
`tests/Feature/Admin/RolePermissionManagementTest.php::test_a_users_permissions_reflect_updated_role_permissions_immediately`
(role permission set changes).

### ⚠️ Known failure mode: stale Laratrust cache after `migrate:fresh`

`migrate:fresh` drops and recreates every table, which resets bigint auto-increment
IDs (`users`, `roles`, `permissions` — see the UUID-deviation note in `CLAUDE.md`)
back to 1. **`migrate:fresh` does not touch Redis.** If a previous seeding pass
cached "user #1 has no roles" (e.g. because something checked permissions for a
plain customer that happened to get ID 1), and a fresh reset+reseed hands ID 1 to
the new SuperAdmin, that stale negative cache entry is served to the new user —
they look completely unauthorized (can't open `/admin/users`, `/admin/roles`,
anything gated by a permission) even though the `role_user` pivot table is correct.

**Fix**: `DatabaseSeeder::run()` calls `Cache::flush()` before seeding anything, so
every `db:seed` (including as part of `migrate:fresh --seed`) starts from a clean
cache regardless of how it was invoked. `make fresh` additionally runs
`php artisan cache:clear` as a second layer of defense for the
`migrate:fresh` (no `--seed`) + separate `db:seed` two-step flow.

If you ever see a freshly-seeded user failing permission checks that look
correct in the database, this is almost always the cause — run
`php artisan cache:clear` before assuming it's a code bug (this is also
documented as a general gotcha in `CLAUDE.md`).

**Regression test**: `tests/Feature/Admin/SeededSuperAdminAccessTest.php` — poisons
the cache for user ID 1 *before* seeding, then asserts the seeded SuperAdmin (which
gets ID 1) can still reach `/admin/users` and `/admin/roles`.

## `dashboard:kpis:*` — DashboardService

**Keys**: `dashboard:kpis:staff` (one shared entry for every staff viewer) or
`dashboard:kpis:business_account:{id}` (one per Business Buyer).

Cached for 60 seconds with no write-triggered flush at all — this is a deliberate
difference from the other two caches. Dashboard KPIs (low-stock count, pending
approvals, today's sales, etc.) change on essentially every write across the whole
app (every order, every stock movement, every payment); wiring a flush into all of
those call sites would mean touching every write path in the system for a page
that's read-only and not correctness-critical. A dashboard that's accurate "as of
the last minute" is an acceptable trade StockFlow makes deliberately; nothing that
reads `stock_levels`/`orders`/`payments` directly for a business decision (checkout,
approval, settlement) ever goes through this cache.

## Local commands

```bash
# Clear everything (all tags, all keys) — safe, always correct, just slower on the next request:
docker compose exec app php artisan cache:clear

# Flush just one tag from tinker, if you want to leave the others warm:
docker compose exec app php artisan tinker --execute="Cache::tags(['catalog'])->flush();"
docker compose exec app php artisan tinker --execute="Cache::tags(['stock-levels'])->flush();"

# Inspect what's actually in Redis:
docker compose exec app php artisan tinker --execute="print_r(app('redis')->connection('cache')->keys('*'));"
```
