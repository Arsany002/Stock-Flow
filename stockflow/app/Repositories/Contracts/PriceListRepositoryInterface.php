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
}
