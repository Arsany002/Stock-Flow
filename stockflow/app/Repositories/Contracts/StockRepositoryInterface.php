<?php

namespace App\Repositories\Contracts;

use App\Models\StockLevel;
use App\Models\StockMovement;
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
}
