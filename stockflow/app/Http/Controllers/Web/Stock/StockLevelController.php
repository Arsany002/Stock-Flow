<?php

namespace App\Http\Controllers\Web\Stock;

use App\Http\Controllers\Controller;
use App\Models\StockLevel;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StockLevelController extends Controller
{
    public function __construct(
        private readonly StockService $stock,
        private readonly CatalogService $catalog,
    ) {}

    public function index(Request $request): Response
    {
        $productId = $request->string('product_id')->toString() ?: null;
        $warehouseId = $request->string('warehouse_id')->toString() ?: null;

        $levels = $this->stock->listLevels(15, [
            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
        ])->through(fn (StockLevel $level) => [
            'id' => $level->id,
            'product' => $level->product?->only(['id', 'name', 'sku']),
            'warehouse' => $level->warehouse?->only(['id', 'name', 'code']),
            'on_hand' => $level->on_hand,
            'reserved' => $level->reserved,
            'available' => $level->available,
            'updated_at' => $level->updated_at,
        ]);

        return Inertia::render('Stock/Levels/Index', [
            'levels' => $levels,
            'filters' => ['product_id' => $productId, 'warehouse_id' => $warehouseId],
            'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
            'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
        ]);
    }
}
