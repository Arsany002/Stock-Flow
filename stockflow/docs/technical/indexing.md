# Indexing and hot queries

All `EXPLAIN` output below was run against the real `stockflow` MySQL 8 dev
database (`docker compose exec app php artisan tinker`), not SQLite — the test
suite's default connection doesn't have real B-tree/FULLTEXT index selection
behavior to validate against (see `CLAUDE.md`'s gotcha on this). Row counts are
small (demo-seed scale), so `rows` estimates below are not representative of
production volume — what matters is `type`/`key`, i.e. whether the optimizer
*can* use an index at all, not how many rows it currently scans.

## Index inventory

| Table | Index | Columns | Serves |
| --- | --- | --- | --- |
| `stock_movements` | `stock_movements_product_id_warehouse_id_created_at_index` | `(product_id, warehouse_id, created_at)` | Ledger lookups for one (product, warehouse) pair ordered by time — `StockRepository::movementsFor()`, the Stock Movement report, `reconcile()`'s per-pair math |
| `stock_movements` | `stock_movements_type_index` | `(type)` | Movement-type filter on the Stock Movement report |
| `stock_movements` | `stock_movements_reference_type_reference_id_index` | `(reference_type, reference_id)` | Looking up every movement caused by one Order/PurchaseOrder |
| `stock_levels` | `stock_levels_product_id_warehouse_id_unique` | `(product_id, warehouse_id)` UNIQUE | The row every stock mutation locks (`lockForUpdate()`/`lockOrCreateLevel()`) — this is *the* hot-path index in the whole schema |
| `orders` | `orders_status_created_at_index` | `(status, created_at)` | Sales report status + date-range filter, `expiredReservations()` |
| `payments` | `payments_status_created_at_index` | `(status, created_at)` | Payments report status + date-range filter |
| `payments` | `payments_method_index` | `(method)` | Payments report method filter |
| `payments` | `payments_gateway_ref_unique` | `(gateway_ref)` UNIQUE | Webhook idempotency (`findByGatewayRef()`) — dedupes duplicate provider callbacks |
| `import_batches` | `import_batches_status_created_at_index` | `(status, created_at)` | Import History report status + date-range filter |
| `activity_log` | `activity_log_causer_id_created_at_index` | `(causer_id, created_at)` | Audit Log report user + date-range filter |
| `activity_log` | `activity_log_event_index` | `(event)` | Audit Log report event filter |
| `activity_log` | `activity_log_subject_type_subject_id_index` | `(subject_type, subject_id)` | Looking up every audit entry about one record |
| `products` | `products_name_fulltext` | FULLTEXT `(name)` | Product search |
| `products` | `products_sku_unique` | `(sku)` UNIQUE | SKU lookups, Excel import upserts |
| `teams` | `teams_warehouse_id_unique` | `(warehouse_id)` UNIQUE | Warehouse ↔ Laratrust team mapping (`WarehouseAccess`) |

Every `foreignId`/`foreignUuid()` column also gets Laravel's automatic
single-column index for the FK itself (visible as `*_foreign` in `SHOW INDEX`) —
not listed individually above, but present on `order_items.product_id`,
`order_items.warehouse_id`, `po_items.product_id`, `po_items.warehouse_id`, etc.

## Hot query EXPLAIN plans

### 1. Stock ledger lookup for one (product, warehouse) pair

```sql
SELECT * FROM stock_movements
WHERE product_id = ? AND warehouse_id = ?
ORDER BY created_at DESC;
```

```
type: ref | key: stock_movements_product_id_warehouse_id_created_at_index
key_len: 288 | ref: const,const | Extra: Backward index scan
```

Index seek on the leading two columns, and the trailing `created_at` column
satisfies the `ORDER BY` without a filesort (`Backward index scan` — MySQL walks
the index in reverse instead of sorting).

### 2. Stock level row lock (the reservation/confirm/release/adjust hot path)

```sql
SELECT * FROM stock_levels
WHERE product_id = ? AND warehouse_id = ?
FOR UPDATE;
```

```
type: const | key: stock_levels_product_id_warehouse_id_unique
key_len: 288 | ref: const,const
```

`type: const` — the unique index guarantees at most one matching row, so MySQL
treats this as a constant lookup. This is the single most important index in the
schema: every `StockService` mutation (`reserve`, `release`, `confirmSale`,
`transfer`, `adjust`, `purchaseIn`) locks through this exact index, under real
concurrency (proven by `tests/Feature/Stock/StockConcurrencyTest.php`).

### 3. Sales report — status filter, newest first

```sql
SELECT * FROM orders WHERE status = ? ORDER BY created_at DESC LIMIT 20;
```

```
type: ref | key: orders_status_created_at_index
key_len: 1 | ref: const | Extra: Backward index scan
```

### 4. Payments report — status + date range, newest first

```sql
SELECT * FROM payments
WHERE status = ? AND created_at >= ?
ORDER BY created_at DESC LIMIT 20;
```

```
type: range | key: payments_status_created_at_index
Extra: Using index condition; Backward index scan
```

### 5. Import History report — status filter, newest first

```sql
SELECT * FROM import_batches WHERE status = ? ORDER BY created_at DESC LIMIT 20;
```

```
type: ref | key: import_batches_status_created_at_index
Extra: Backward index scan
```

### 6. Audit Log report — user filter, newest first

```sql
SELECT * FROM activity_log WHERE causer_id = ? ORDER BY created_at DESC LIMIT 20;
```

```
type: ref | key: activity_log_causer_id_created_at_index
Extra: Backward index scan
```

### 7. Product search

```sql
SELECT * FROM products WHERE MATCH(name) AGAINST(? IN NATURAL LANGUAGE MODE);
```

```
type: fulltext | key: products_name_fulltext
```

### 8. Low Stock report — **the one query that can't use an index**

```sql
SELECT product_id, warehouse_id, (on_hand - reserved) AS available
FROM stock_levels
WHERE (on_hand - reserved) <= ?;
```

```
type: ALL | key: (none) | Extra: Using where
```

`on_hand - reserved` is a computed expression, not a stored column — no plain
B-tree index can serve an inequality on it (MySQL 8 supports functional indexes
on a stored generated column, which would fix this, but `available` is
deliberately *never* a stored column anywhere in this schema — see
`docs/project/canonical-decisions.md` §6, "`available` is always computed, never
stored"). This is a **deliberate, accepted trade-off**: `stock_levels` has one
row per `(product, warehouse)` pair — hundreds to low thousands of rows even at
a large multi-warehouse catalog's scale, not millions — so a full table scan
here is cheap in absolute terms even though `EXPLAIN` shows `type: ALL`. Do not
"fix" this by adding a stored/generated `available` column without an explicit
decision — it would violate the ledger-is-truth invariant that
`stock_levels` is a projection, not a place additional derived state lives.

## Verifying after a schema change

```bash
# Open a MySQL shell against the same DB the app uses:
docker compose exec app php artisan tinker

# Then, in tinker:
DB::select('EXPLAIN SELECT ...');

# Or list every index on a table directly:
DB::select('SHOW INDEX FROM stock_movements');
```

`tests/Feature/Schema/DatabaseSchemaTest.php` (real MySQL, not SQLite) asserts
the unique/FULLTEXT constraints this document describes actually exist —
re-run it after any migration that touches an indexed column:

```bash
docker compose exec app php artisan test --filter=DatabaseSchemaTest
```
