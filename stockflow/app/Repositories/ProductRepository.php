<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function find(string $id): ?Product
    {
        return Product::query()->find($id);
    }

    public function findWithRelations(string $id): ?Product
    {
        return Product::query()->with(['category', 'supplier', 'priceListItems.priceList'])->find($id);
    }

    public function findBySku(string $sku): ?Product
    {
        return Product::query()->where('sku', $sku)->first();
    }

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = Product::query()->with('category')->orderBy('name');

        if (! empty($filters['search'])) {
            $this->applySearch($query, $filters['search']);
        }

        if (! empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (! empty($filters['supplier_id'])) {
            $query->where('supplier_id', $filters['supplier_id']);
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function create(array $attributes): Product
    {
        return Product::query()->create($attributes);
    }

    public function update(Product $product, array $attributes): Product
    {
        $product->update($attributes);

        return $product;
    }

    public function delete(Product $product): bool
    {
        return (bool) $product->delete();
    }

    /**
     * FULLTEXT search on real MySQL (matches the products_name_fulltext
     * index — see the products migration); falls back to LIKE on SQLite,
     * which the app's fast feature-test suite runs on.
     */
    private function applySearch(Builder $query, string $search): void
    {
        if (DB::connection()->getDriverName() === 'mysql') {
            $query->whereFullText('name', $search);

            return;
        }

        $query->where('name', 'like', "%{$search}%");
    }
}
