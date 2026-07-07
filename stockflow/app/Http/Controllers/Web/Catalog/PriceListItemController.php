<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StorePriceListItemRequest;
use App\Http\Requests\Catalog\UpdatePriceListItemRequest;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Services\CatalogService;
use Illuminate\Http\RedirectResponse;

class PriceListItemController extends Controller
{
    public function __construct(private readonly CatalogService $catalog) {}

    public function store(StorePriceListItemRequest $request, PriceList $priceList): RedirectResponse
    {
        $this->catalog->createPriceListItem([
            ...$request->validated(),
            'price_list_id' => $priceList->id,
        ]);

        return redirect()
            ->route('catalog.price-lists.index')
            ->with('flash.success', 'Price list item added.');
    }

    public function update(UpdatePriceListItemRequest $request, PriceListItem $priceListItem): RedirectResponse
    {
        $this->catalog->updatePriceListItem($priceListItem, $request->validated());

        return redirect()
            ->route('catalog.price-lists.index')
            ->with('flash.success', 'Price list item updated.');
    }

    public function destroy(PriceListItem $priceListItem): RedirectResponse
    {
        $this->authorize('deleteItem', $priceListItem);

        $this->catalog->deletePriceListItem($priceListItem);

        return redirect()
            ->route('catalog.price-lists.index')
            ->with('flash.success', 'Price list item removed.');
    }
}
