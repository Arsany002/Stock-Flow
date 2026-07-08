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
     * Active-only lookup by SKU for the public storefront's product detail
     * page — an inactive product must 404 there, not just render with a
     * "hidden" flag, so this returns null instead of an inactive Product.
     */
    public function findActiveBySku(string $sku): ?Product;

    /**
     * @param  array<string, mixed>  $filters  e.g. ['search' => 'laptop', 'category_id' => '...']
     */
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Same shape as paginate(), but always scoped to is_active=true — the
     * public storefront listing/search/category pages. Kept as a separate
     * method (rather than an $filters['is_active'] flag on paginate())
     * so the admin catalog listing can never accidentally forget to
     * exclude inactive products, and vice versa.
     *
     * @param  array<string, mixed>  $filters  e.g. ['search' => 'laptop', 'category_id' => '...']
     */
    public function publicPaginatedList(int $perPage = 15, array $filters = []): LengthAwarePaginator;

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
