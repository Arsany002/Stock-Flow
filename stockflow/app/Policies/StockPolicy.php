<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Models\User;
use App\Models\Warehouse;
use App\Support\WarehouseAccess;

/**
 * Record-level authorization for stock mutations. `stock.move` /
 * `stock.transfer` (route middleware) are the coarse gates; this restricts
 * them to the specific warehouse(s) involved, via Laratrust teams
 * (Enterprise PRD §3, "team" cell — Inventory Manager only; SuperAdmin
 * bypasses). `stock.read` and the reconcile command have no record to
 * scope against, so route middleware alone is their full gate — no methods
 * needed here for those. See docs/project/canonical-decisions.md §2 and
 * App\Support\WarehouseAccess.
 */
class StockPolicy
{
    public function move(User $user, Warehouse $warehouse): bool
    {
        return WarehouseAccess::allows($user, $warehouse, PermissionName::StockMove);
    }

    public function adjust(User $user, Warehouse $warehouse): bool
    {
        return $this->move($user, $warehouse);
    }

    public function transfer(User $user, Warehouse $fromWarehouse, Warehouse $toWarehouse): bool
    {
        return WarehouseAccess::allows($user, $fromWarehouse, PermissionName::StockTransfer)
            && WarehouseAccess::allows($user, $toWarehouse, PermissionName::StockTransfer);
    }
}
