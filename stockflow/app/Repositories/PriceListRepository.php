<?php

namespace App\Repositories;

use App\Enums\PriceListType;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Repositories\Contracts\PriceListRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PriceListRepository implements PriceListRepositoryInterface
{
    public function find(string $id): ?PriceList
    {
        return PriceList::query()->find($id);
    }

    public function paginateWithItems(int $perPage = 15): LengthAwarePaginator
    {
        return PriceList::query()
            ->with(['items.product:id,name,sku'])
            ->orderBy('name')
            ->paginate($perPage);
    }

    public function create(array $attributes): PriceList
    {
        return PriceList::query()->create($attributes);
    }

    public function update(PriceList $priceList, array $attributes): PriceList
    {
        $priceList->update($attributes);

        return $priceList;
    }

    public function findItem(string $id): ?PriceListItem
    {
        return PriceListItem::query()->with('product.supplier')->find($id);
    }

    public function createItem(array $attributes): PriceListItem
    {
        return PriceListItem::query()->create($attributes);
    }

    public function updateItem(PriceListItem $item, array $attributes): PriceListItem
    {
        $item->update($attributes);

        return $item;
    }

    public function deleteItem(PriceListItem $item): bool
    {
        return (bool) $item->delete();
    }

    public function activeRetailItemFor(string $productId, int $quantity): ?PriceListItem
    {
        return $this->activeItemFor(PriceListType::B2cRetail, $productId, $quantity);
    }

    public function activeTierItemFor(string $productId, int $quantity): ?PriceListItem
    {
        return $this->activeItemFor(PriceListType::B2bTier, $productId, $quantity);
    }

    private function activeItemFor(PriceListType $type, string $productId, int $quantity): ?PriceListItem
    {
        return PriceListItem::query()
            ->whereHas('priceList', fn ($query) => $query
                ->where('type', $type)
                ->where('is_active', true))
            ->where('product_id', $productId)
            ->where('min_qty', '<=', $quantity)
            ->orderByDesc('min_qty')
            ->first();
    }
}
