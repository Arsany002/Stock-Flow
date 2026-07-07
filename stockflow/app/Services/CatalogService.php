<?php

namespace App\Services;

use App\Models\Category;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\Supplier;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\PriceListRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\SupplierRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Catalog reads and writes (FR-3.1–3.5). Reads are cache-aside under a
 * single 'catalog' Redis tag; every write flushes that whole tag rather
 * than trying to bust individual keys — simple and correct given products,
 * categories, and price lists all influence each other's listings.
 * See docs/project/canonical-decisions.md §11 and requirement #4/#5.
 */
class CatalogService
{
    private const CACHE_TAG = 'catalog';

    /**
     * Catalog reads TTL — 1 hour, per the Enterprise PRD §11.
     */
    private const CACHE_TTL = 3600;

    public function __construct(
        private readonly ProductRepositoryInterface $products,
        private readonly CategoryRepositoryInterface $categories,
        private readonly SupplierRepositoryInterface $suppliers,
        private readonly PriceListRepositoryInterface $priceLists,
    ) {}

    // ---------------------------------------------------------------
    // Products
    // ---------------------------------------------------------------

    /**
     * @param  array<string, mixed>  $filters
     */
    public function listProducts(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage() ?: 1;

        return $this->remember(
            $this->cacheKey('products', $page, $perPage, $filters),
            fn () => $this->products->paginate($perPage, $filters)
        );
    }

    public function findProduct(string $id): ?Product
    {
        return $this->products->find($id);
    }

    public function findProductWithRelations(string $id): ?Product
    {
        return $this->products->findWithRelations($id);
    }

    public function findProductBySku(string $sku): ?Product
    {
        return $this->products->findBySku($sku);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createProduct(array $attributes): Product
    {
        $product = $this->products->create($attributes);

        $this->flushCache();

        return $product;
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateProduct(Product $product, array $attributes): Product
    {
        $product = $this->products->update($product, $attributes);

        $this->flushCache();

        return $product;
    }

    public function deleteProduct(Product $product): bool
    {
        $deleted = $this->products->delete($product);

        $this->flushCache();

        return $deleted;
    }

    // ---------------------------------------------------------------
    // Categories
    // ---------------------------------------------------------------

    /**
     * @return Collection<int, Category>
     */
    public function listCategories(): Collection
    {
        return $this->remember(
            $this->cacheKey('categories'),
            fn () => $this->categories->allWithChildren()
        );
    }

    /**
     * Flat list for select-dropdown use (product/category forms).
     *
     * @return Collection<int, Category>
     */
    public function listCategoriesFlat(): Collection
    {
        return $this->remember(
            $this->cacheKey('categories', 'flat'),
            fn () => $this->categories->all()
        );
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createCategory(array $attributes): Category
    {
        $category = $this->categories->create($attributes);

        $this->flushCache();

        return $category;
    }

    public function deleteCategory(Category $category): bool
    {
        $deleted = $this->categories->delete($category);

        $this->flushCache();

        return $deleted;
    }

    // ---------------------------------------------------------------
    // Suppliers
    // ---------------------------------------------------------------

    public function listSuppliers(int $perPage = 15): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage() ?: 1;

        return $this->remember(
            $this->cacheKey('suppliers', $page, $perPage),
            fn () => $this->suppliers->paginate($perPage)
        );
    }

    /**
     * Flat list of active suppliers for select-dropdown use (product form).
     *
     * @return Collection<int, Supplier>
     */
    public function listSuppliersFlat(): Collection
    {
        return $this->remember(
            $this->cacheKey('suppliers', 'flat'),
            fn () => $this->suppliers->all()
        );
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createSupplier(array $attributes): Supplier
    {
        $supplier = $this->suppliers->create($attributes);

        $this->flushCache();

        return $supplier;
    }

    public function deleteSupplier(Supplier $supplier): bool
    {
        $deleted = $this->suppliers->delete($supplier);

        $this->flushCache();

        return $deleted;
    }

    // ---------------------------------------------------------------
    // Price lists & items
    // ---------------------------------------------------------------

    public function listPriceLists(int $perPage = 15): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage() ?: 1;

        return $this->remember(
            $this->cacheKey('price_lists', $page, $perPage),
            fn () => $this->priceLists->paginateWithItems($perPage)
        );
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createPriceList(array $attributes): PriceList
    {
        $priceList = $this->priceLists->create($attributes);

        $this->flushCache();

        return $priceList;
    }

    public function findPriceListItem(string $id): ?PriceListItem
    {
        return $this->priceLists->findItem($id);
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createPriceListItem(array $attributes): PriceListItem
    {
        $item = $this->priceLists->createItem($attributes);

        $this->flushCache();

        return $item;
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updatePriceListItem(PriceListItem $item, array $attributes): PriceListItem
    {
        $item = $this->priceLists->updateItem($item, $attributes);

        $this->flushCache();

        return $item;
    }

    public function deletePriceListItem(PriceListItem $item): bool
    {
        $deleted = $this->priceLists->deleteItem($item);

        $this->flushCache();

        return $deleted;
    }

    // ---------------------------------------------------------------

    private function remember(string $key, \Closure $callback): mixed
    {
        return Cache::tags([self::CACHE_TAG])->remember($key, self::CACHE_TTL, $callback);
    }

    private function cacheKey(string $entity, mixed ...$parts): string
    {
        return sprintf('catalog:%s:%s', $entity, md5(json_encode($parts)));
    }

    private function flushCache(): void
    {
        Cache::tags([self::CACHE_TAG])->flush();
    }
}
