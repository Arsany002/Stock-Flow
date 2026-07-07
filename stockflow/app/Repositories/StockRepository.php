<?php

namespace App\Repositories;

use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Repositories\Contracts\StockRepositoryInterface;
use Illuminate\Support\Collection;

class StockRepository implements StockRepositoryInterface
{
    public function findLevel(string $productId, string $warehouseId): ?StockLevel
    {
        return StockLevel::query()
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->first();
    }

    public function lockLevelForUpdate(string $productId, string $warehouseId): ?StockLevel
    {
        return StockLevel::query()
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->lockForUpdate()
            ->first();
    }

    public function createLevel(array $attributes): StockLevel
    {
        return StockLevel::query()->create($attributes);
    }

    public function updateLevel(StockLevel $level, array $attributes): StockLevel
    {
        $level->update($attributes);

        return $level;
    }

    public function createMovement(array $attributes): StockMovement
    {
        return StockMovement::query()->create($attributes);
    }

    public function movementsFor(string $productId, string $warehouseId): Collection
    {
        return StockMovement::query()
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->orderBy('created_at')
            ->get();
    }
}
