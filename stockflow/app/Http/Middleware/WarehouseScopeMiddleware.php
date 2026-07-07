<?php

namespace App\Http\Middleware;

use App\Enums\PermissionName;
use App\Exceptions\UnauthorizedWarehouseException;
use App\Models\Warehouse;
use App\Support\WarehouseAccess;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Route-level, defense-in-depth counterpart to StockPolicy: rejects a
 * stock.move/stock.transfer request before it ever reaches the controller
 * if the acting user isn't scoped to every warehouse the request touches
 * (via Laratrust teams — see App\Support\WarehouseAccess).
 *
 * Usage: `->middleware('warehouse.scope:stock.move')` on a route whose
 * request carries `warehouse_id`, or `from_warehouse_id`/`to_warehouse_id`
 * for transfers. See docs/project/canonical-decisions.md §3.
 */
class WarehouseScopeMiddleware
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();
        $permissionEnum = PermissionName::from($permission);

        foreach ($this->resolveWarehouseIds($request) as $warehouseId) {
            $warehouse = Warehouse::query()->find($warehouseId);

            // An unknown/missing id isn't this middleware's job — the
            // FormRequest's `exists:warehouses,id` rule rejects it with a
            // normal validation error instead of a 403.
            if ($warehouse === null) {
                continue;
            }

            if (! WarehouseAccess::allows($user, $warehouse, $permissionEnum)) {
                throw UnauthorizedWarehouseException::forWarehouse($warehouseId);
            }
        }

        return $next($request);
    }

    /**
     * @return list<string>
     */
    private function resolveWarehouseIds(Request $request): array
    {
        $routeWarehouse = $request->route('warehouse');

        return array_values(array_unique(array_filter([
            is_object($routeWarehouse) ? $routeWarehouse->id : $routeWarehouse,
            $request->input('warehouse_id'),
            $request->input('from_warehouse_id'),
            $request->input('to_warehouse_id'),
        ])));
    }
}
