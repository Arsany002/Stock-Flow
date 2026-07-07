<?php

namespace App\Http\Controllers\Web\Stock;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StoreStockTransferRequest;
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class StockTransferController extends Controller
{
    public function __construct(
        private readonly StockService $stock,
        private readonly CatalogService $catalog,
    ) {}

    public function create(): Response
    {
        return Inertia::render('Stock/Transfers/Create', [
            'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
            'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
        ]);
    }

    public function store(StoreStockTransferRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $product = Product::query()->findOrFail($data['product_id']);
        $fromWarehouse = Warehouse::query()->findOrFail($data['from_warehouse_id']);
        $toWarehouse = Warehouse::query()->findOrFail($data['to_warehouse_id']);

        $this->stock->transfer(
            $product,
            $fromWarehouse,
            $toWarehouse,
            (int) $data['quantity'],
            Auth::user(),
        );

        return redirect()
            ->route('stock.levels.index')
            ->with('flash.success', "Transferred {$data['quantity']} × \"{$product->name}\" from {$fromWarehouse->name} to {$toWarehouse->name}.");
    }
}
