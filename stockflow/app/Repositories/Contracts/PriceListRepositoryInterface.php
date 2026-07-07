<?php

namespace App\Repositories\Contracts;

use App\Models\PriceList;
use App\Models\PriceListItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PriceListRepositoryInterface
{
    public function find(string $id): ?PriceList;

    public function paginateWithItems(int $perPage = 15): LengthAwarePaginator;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): PriceList;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(PriceList $priceList, array $attributes): PriceList;

    public function findItem(string $id): ?PriceListItem;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createItem(array $attributes): PriceListItem;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateItem(PriceListItem $item, array $attributes): PriceListItem;

    public function deleteItem(PriceListItem $item): bool;

    /**
     * The active `b2c_retail` price list's item for this product with the
     * highest `min_qty` that's still `<= $quantity` (retail lists in
     * practice only carry a single min_qty=1 tier, but this stays correct
     * if that ever changes). Null if no active retail list prices this
     * product at all.
     */
    public function activeRetailItemFor(string $productId, int $quantity): ?PriceListItem;

    /**
     * The active `b2b_tier` price list's item for this product with the
     * highest `min_qty` that's still `<= $quantity` — used as a starting
     * suggestion when a Vendor/Inventory Manager prices a B2B quote line.
     * Null if no active tier list prices this product at all.
     */
    public function activeTierItemFor(string $productId, int $quantity): ?PriceListItem;
}
