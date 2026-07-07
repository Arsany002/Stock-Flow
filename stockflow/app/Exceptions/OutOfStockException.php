<?php

namespace App\Exceptions;

/**
 * Thrown when a reservation/confirmation would require more stock than is
 * currently available (on_hand - reserved) for a (product, warehouse) pair.
 *
 * @see docs/project/canonical-decisions.md §6 — no oversell under concurrency.
 */
class OutOfStockException extends DomainException
{
    public static function forProduct(string $productId, string $warehouseId, int $requested, int $available): self
    {
        return new self(
            "Insufficient stock for product [{$productId}] in warehouse [{$warehouseId}]: ".
            "requested {$requested}, available {$available}.",
            [
                'product_id' => $productId,
                'warehouse_id' => $warehouseId,
                'requested' => $requested,
                'available' => $available,
            ]
        );
    }
}
