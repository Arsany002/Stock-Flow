<?php

namespace App\Http\Controllers\Web\Stock;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Warehouse;
use App\Services\CatalogService;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Read-only reconciliation report: proves (or disproves) that stock_levels
 * matches what the immutable stock_movements ledger says it should be. No
 * mutation, so `stock.move` and `audit.read` are both accepted gates — see
 * routes/web.php.
 */
class StockReconciliationController extends Controller
{
    public function __construct(
        private readonly StockService $stock,
        private readonly CatalogService $catalog,
    ) {}

    public function show(Request $request): Response
    {
        return Inertia::render('Stock/Reconciliation/Show', [
            'results' => $this->runReconciliation($request),
            'filters' => $this->filters($request),
            'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
            'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
        ]);
    }

    public function run(Request $request): RedirectResponse
    {
        $results = $this->runReconciliation($request);
        $mismatches = $results->reject(fn (array $row) => $row['on_hand_matches'] && $row['reserved_matches'])->count();

        return redirect()
            ->route('stock.reconcile.show', $this->filters($request))
            ->with(
                $mismatches === 0 ? 'flash.success' : 'flash.error',
                $mismatches === 0
                    ? 'Reconciliation passed — the ledger matches stock_levels for every row checked.'
                    : "Reconciliation found {$mismatches} mismatched (product, warehouse) row(s).",
            );
    }

    /** @return array{product_id: ?string, warehouse_id: ?string} */
    private function filters(Request $request): array
    {
        return [
            'product_id' => $request->string('product_id')->toString() ?: null,
            'warehouse_id' => $request->string('warehouse_id')->toString() ?: null,
        ];
    }

    private function runReconciliation(Request $request)
    {
        $filters = $this->filters($request);

        $product = $filters['product_id'] ? Product::query()->find($filters['product_id']) : null;
        $warehouse = $filters['warehouse_id'] ? Warehouse::query()->find($filters['warehouse_id']) : null;

        return $this->stock->reconcile($product, $warehouse);
    }
}
