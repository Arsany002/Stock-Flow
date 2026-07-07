<?php

namespace App\Http\Controllers\Web\Stock;

use App\Enums\MovementType;
use App\Http\Controllers\Controller;
use App\Models\StockMovement;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StockMovementController extends Controller
{
    public function __construct(
        private readonly StockService $stock,
        private readonly CatalogService $catalog,
    ) {}

    public function index(Request $request): Response
    {
        $productId = $request->string('product_id')->toString() ?: null;
        $warehouseId = $request->string('warehouse_id')->toString() ?: null;
        $type = $request->string('type')->toString() ?: null;

        $movements = $this->stock->listMovements(20, [
            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
            'type' => $type,
        ])->through(fn (StockMovement $movement) => [
            'id' => $movement->id,
            'product' => $movement->product?->only(['id', 'name', 'sku']),
            'warehouse' => $movement->warehouse?->only(['id', 'name', 'code']),
            'type' => $movement->type->value,
            'type_label' => $movement->type->label(),
            'quantity' => $movement->quantity,
            'reason' => $movement->reason,
            'actor' => $movement->actor?->only(['id', 'name']),
            'created_at' => $movement->created_at,
        ]);

        return Inertia::render('Stock/Movements/Index', [
            'movements' => $movements,
            'filters' => ['product_id' => $productId, 'warehouse_id' => $warehouseId, 'type' => $type],
            'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
            'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
            'types' => collect(MovementType::cases())->map(fn (MovementType $type) => [
                'value' => $type->value,
                'label' => $type->label(),
            ]),
        ]);
    }
}
