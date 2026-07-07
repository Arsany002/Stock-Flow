<?php

namespace App\Support;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\User;
use App\Models\Warehouse;

/**
 * Shared warehouse-scoping check used by both StockPolicy (record-level,
 * called from controllers) and WarehouseScopeMiddleware (route-level,
 * defense-in-depth) — see docs/project/canonical-decisions.md §3.
 *
 * SuperAdmin has full access to every warehouse regardless of team
 * assignment (Enterprise PRD §3 permission matrix: stock.move/stock.transfer
 * are "✓" for SuperAdmin, "team" for Inventory Manager only). Everyone else
 * needs the base Laratrust permission AND a role assignment scoped to the
 * warehouse's team (role_user.team_id) — see Warehouse::booted() for how
 * each warehouse gets its team.
 */
final class WarehouseAccess
{
    public static function allows(?User $user, ?Warehouse $warehouse, PermissionName $permission): bool
    {
        if ($user === null || $warehouse === null) {
            return false;
        }

        if (! $user->isAbleTo($permission->value)) {
            return false;
        }

        if ($user->hasRole(UserRole::SuperAdmin->value)) {
            return true;
        }

        $team = $warehouse->team;

        return $team !== null && $user->isAbleTo($permission->value, $team);
    }
}
