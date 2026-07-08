<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Public-storefront reads: active products/categories only, and product
 * payloads shaped for a guest (price + stock badge, never an exact
 * quantity). Deliberately a separate service from CatalogService rather
 * than adding an `is_active` filter flag everywhere in it — CatalogService
 * is the admin/CRUD surface (sees inactive products on purpose, for
 * reactivating them), this is the public-visibility surface, and keeping
 * them apart means a future admin-only field can never leak here by
 * accident. Categories and retail pricing are read straight from
 * CatalogService though, since those are already cached under the same
 * 'catalog' tag and don't need an is_active filter (categories have no
 * such column; retailPriceFor() only returns a price for lines that will
 * actually be sellable).
 */
class StorefrontCatalogService
{
    private const CACHE_TAG = 'catalog';

    private const CACHE_TTL = 3600;

    public function __construct(
        private readonly ProductRepositoryInterface $products,
        private readonly CatalogService $catalog,
        private readonly StockAvailabilityService $availability,
    ) {}

    /**
     * @param  array<string, mixed>  $filters
     */
    public function listActiveProducts(int $perPage, array $filters = []): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage() ?: 1;

        return Cache::tags([self::CACHE_TAG])->remember(
            sprintf('storefront:products:%s', md5(json_encode([$page, $perPage, $filters]))),
            self::CACHE_TTL,
            fn () => $this->products->publicPaginatedList($perPage, $filters)
        );
    }

    public function findActiveProductBySku(string $sku): ?Product
    {
        // Not cached individually — a single indexed row lookup is cheap,
        // and per-SKU cache keys would need their own invalidation on top
        // of the tag flush. Matches CatalogService::findProduct() also
        // being a live read.
        return $this->products->findActiveBySku($sku);
    }

    /**
     * @return Collection<int, Category>
     */
    public function publicCategories(): Collection
    {
        return $this->catalog->listCategories();
    }

    /**
     * Reshape a paginator of Products into public-safe payloads, batching
     * the stock-availability lookup for every item on the page into one
     * query instead of N.
     */
    public function presentPaginated(LengthAwarePaginator $paginator): LengthAwarePaginator
    {
        $availability = $this->availability->totalAvailableForMany(
            collect($paginator->items())->pluck('id')->all()
        );

        return $paginator->through(
            fn (Product $product) => $this->presentProduct($product, $availability[$product->id] ?? 0)
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function presentProduct(Product $product, ?int $available = null): array
    {
        $priceItem = $this->catalog->retailPriceFor($product->id, 1);
        $available ??= $this->availability->totalAvailableFor($product->id);
        $status = $this->availability->statusFor($available);

        return [
            'id' => $product->id,
            'sku' => $product->sku,
            'name' => $product->name,
            'description' => $product->description,
            'category' => $product->relationLoaded('category') && $product->category !== null
                ? ['id' => $product->category->id, 'name' => $product->category->name, 'slug' => $product->category->slug]
                : null,
            'price' => $priceItem?->unit_price,
            'stock_status' => $status,
            'stock_label' => $this->availability->labelFor($status),
            'can_add_to_cart' => $status !== StockAvailabilityService::STATUS_OUT_OF_STOCK,
        ];
    }
}
