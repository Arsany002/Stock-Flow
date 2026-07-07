<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StorePriceListRequest;
use App\Models\PriceList;
use App\Services\CatalogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PriceListController extends Controller
{
    public function __construct(private readonly CatalogService $catalog) {}

    public function index(Request $request): Response
    {
        $this->authorize('viewAny', PriceList::class);

        $priceLists = $this->catalog->listPriceLists(15)->through(fn (PriceList $priceList) => [
            'id' => $priceList->id,
            'name' => $priceList->name,
            'type' => $priceList->type->value,
            'is_active' => $priceList->is_active,
            'items' => $priceList->items->map(fn ($item) => [
                'id' => $item->id,
                'product' => $item->product->only(['id', 'name', 'sku']),
                'unit_price' => $item->unit_price,
                'min_qty' => $item->min_qty,
            ]),
        ]);

        return Inertia::render('Catalog/PriceLists/Index', [
            'priceLists' => $priceLists,
            'canManagePriceLists' => $request->user()->can('create', PriceList::class),
        ]);
    }

    public function store(StorePriceListRequest $request): RedirectResponse
    {
        $priceList = $this->catalog->createPriceList($request->validated());

        return redirect()
            ->route('catalog.price-lists.index')
            ->with('flash.success', "Price list \"{$priceList->name}\" created.");
    }
}
