<?php

namespace App\Exceptions;

/**
 * Thrown when a warehouse-scoped action (stock.move, stock.transfer) is
 * attempted against a warehouse outside the actor's assigned Laratrust
 * team(s).
 *
 * @see docs/project/canonical-decisions.md §3 — warehouse-scoping via
 *      Laratrust teams (one team per warehouse).
 */
class UnauthorizedWarehouseException extends DomainException
{
    public static function forWarehouse(string $warehouseId): self
    {
        return new self(
            "The current user is not authorized to act on warehouse [{$warehouseId}].",
            ['warehouse_id' => $warehouseId]
        );
    }
}
