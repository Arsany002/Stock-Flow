<?php

namespace App\Http\Controllers\Web\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StoreStockAdjustmentRequest;
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class StockAdjustmentController extends Controller
{
    public function __construct(
        private readonly StockService $stock,
        private readonly CatalogService $catalog,
    ) {}

    public function create(): Response
    {
        return Inertia::render('Stock/Adjustments/Create', [
            'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
            'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
        ]);
    }

    public function store(StoreStockAdjustmentRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $product = Product::query()->findOrFail($data['product_id']);
        $warehouse = Warehouse::query()->findOrFail($data['warehouse_id']);

        $level = $this->stock->adjust(
            $product,
            $warehouse,
            (int) $data['quantity'],
            Auth::user(),
            $data['reason'],
        );

        return redirect()
            ->route('stock.levels.index')
            ->with('flash.success', "Stock adjusted for \"{$product->name}\" at {$warehouse->name} — on hand is now {$level->on_hand}.");
    }
}
