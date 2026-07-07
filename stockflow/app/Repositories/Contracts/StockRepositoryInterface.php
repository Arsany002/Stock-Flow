<?php

namespace App\Repositories\Contracts;

use App\Models\StockLevel;
use App\Models\StockMovement;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface StockRepositoryInterface
{
    public function findLevel(string $productId, string $warehouseId): ?StockLevel;

    /**
     * Lock the (product, warehouse) row for update within the caller's
     * transaction. Callers are responsible for wrapping this in
     * DB::transaction() — locking is meaningless outside one.
     */
    public function lockLevelForUpdate(string $productId, string $warehouseId): ?StockLevel;

    /**
     * Lock the (product, warehouse) row for update, creating it (on_hand=0,
     * reserved=0) first if it doesn't exist yet. Race-safe: if two
     * transactions both try to create the same brand-new pair
     * concurrently, the loser's insert hits the stock_levels
     * (product_id, warehouse_id) unique constraint and falls back to
     * locking the winner's row instead of erroring. Must be called inside
     * the caller's DB::transaction().
     */
    public function lockOrCreateLevel(string $productId, string $warehouseId): StockLevel;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createLevel(array $attributes): StockLevel;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateLevel(StockLevel $level, array $attributes): StockLevel;

    /**
     * Append an immutable movement row. Never update or delete a movement.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function createMovement(array $attributes): StockMovement;

    /**
     * @return Collection<int, StockMovement>
     */
    public function movementsFor(string $productId, string $warehouseId): Collection;

    /**
     * Paginated, filterable listing for the Stock/Levels/Index page.
     *
     * @param  array<string, mixed>  $filters  e.g. ['product_id' => ..., 'warehouse_id' => ...]
     */
    public function paginateLevels(int $perPage, array $filters = []): LengthAwarePaginator;

    /**
     * Paginated, filterable listing for the Stock/Movements/Index page.
     *
     * @param  array<string, mixed>  $filters  e.g. ['product_id' => ..., 'warehouse_id' => ..., 'type' => ...]
     */
    public function paginateMovements(int $perPage, array $filters = []): LengthAwarePaginator;

    /**
     * All stock_levels rows (the projection side of reconciliation),
     * optionally filtered.
     *
     * @return Collection<int, StockLevel>
     */
    public function allLevels(?string $productId = null, ?string $warehouseId = null): Collection;

    /**
     * One row per (product, warehouse) pair with ledger-derived on_hand/
     * reserved already summed in a single grouped query — the ledger side
     * of reconciliation. `ledger_on_hand` sums purchase_in/sale_out/
     * adjustment/transfer_in/transfer_out (the types that affect on_hand);
     * `ledger_reserved` sums reservation/release/sale_out (the types that
     * affect reserved). See StockService's docblock for the full reasoning.
     *
     * @return Collection<int, object{product_id: string, warehouse_id: string, ledger_on_hand: int, ledger_reserved: int}>
     */
    public function ledgerTotals(?string $productId = null, ?string $warehouseId = null): Collection;
}
