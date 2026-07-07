<?php

namespace App\Services;

use App\Repositories\Contracts\StockRepositoryInterface;

/**
 * Skeleton only — reserve/confirm/transfer/release/adjust are implemented
 * in the stock engine module. Each will run inside DB::transaction() +
 * lockForUpdate() per docs/project/canonical-decisions.md §6.
 */
class StockService
{
    public function __construct(private readonly StockRepositoryInterface $stock) {}

    public function reserve(string $productId, string $warehouseId, int $quantity): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function confirm(string $productId, string $warehouseId, int $quantity): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function transfer(string $productId, string $fromWarehouseId, string $toWarehouseId, int $quantity): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function release(string $productId, string $warehouseId, int $quantity): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function adjust(string $productId, string $warehouseId, int $delta, string $reason): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }
}
