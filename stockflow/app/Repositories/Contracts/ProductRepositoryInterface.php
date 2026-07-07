<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function find(string $id): ?Product;

    public function findWithRelations(string $id): ?Product;

    public function findBySku(string $sku): ?Product;

    /**
     * @param  array<string, mixed>  $filters  e.g. ['search' => 'laptop', 'category_id' => '...']
     */
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Product;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(Product $product, array $attributes): Product;

    public function delete(Product $product): bool;
}
