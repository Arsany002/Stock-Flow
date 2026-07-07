<?php

namespace Tests\Feature\Catalog;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

/**
 * Proves requirement #4/#5: catalog listings are cached (Redis, tag
 * 'catalog' — see CatalogService), and every product/category/price-list
 * write flushes that cache so the next read is never stale.
 */
class CatalogCacheTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    private function inventoryManager(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);

        return $user;
    }

    public function test_product_listing_cache_invalidates_after_creating_a_product(): void
    {
        $manager = $this->inventoryManager();
        Product::factory()->count(2)->create();

        $this->actingAs($manager)
            ->get('/catalog/products')
            ->assertInertia(fn (Assert $page) => $page->has('products.data', 2));

        $category = Category::factory()->create();
        $this->actingAs($manager)->post('/catalog/products', [
            'category_id' => $category->id,
            'sku' => 'SKU-CACHE-TEST',
            'name' => 'Cache Test Widget',
            'is_active' => true,
        ])->assertRedirect();

        // If the cache had not been flushed, this would still report 2.
        $this->actingAs($manager)
            ->get('/catalog/products')
            ->assertInertia(fn (Assert $page) => $page->has('products.data', 3));
    }

    public function test_category_listing_cache_invalidates_after_creating_a_category(): void
    {
        $manager = $this->inventoryManager();
        Category::factory()->create();

        $this->actingAs($manager)
            ->get('/catalog/categories')
            ->assertInertia(fn (Assert $page) => $page->has('categories', 1));

        $this->actingAs($manager)->post('/catalog/categories', [
            'name' => 'Fresh Category',
            'slug' => 'fresh-category',
        ])->assertRedirect();

        $this->actingAs($manager)
            ->get('/catalog/categories')
            ->assertInertia(fn (Assert $page) => $page->has('categories', 2));
    }

    public function test_price_list_listing_cache_invalidates_after_creating_a_price_list(): void
    {
        $manager = $this->inventoryManager();
        PriceList::factory()->create();

        $this->actingAs($manager)
            ->get('/catalog/price-lists')
            ->assertInertia(fn (Assert $page) => $page->has('priceLists.data', 1));

        $this->actingAs($manager)->post('/catalog/price-lists', [
            'name' => 'Fresh Price List',
            'type' => 'b2c_retail',
            'is_active' => true,
        ])->assertRedirect();

        $this->actingAs($manager)
            ->get('/catalog/price-lists')
            ->assertInertia(fn (Assert $page) => $page->has('priceLists.data', 2));
    }

    /**
     * Regression test: the ArrayStore cache driver used by the rest of this
     * suite (see phpunit.xml) never actually serializes values, so it can't
     * catch bugs in the real Redis (de)serialization path. This test
     * switches to the app's real `redis` cache store — the same one dev/prod
     * use — and reads a cached catalog listing TWICE (the second read is a
     * genuine cache hit requiring unserialize()), proving cached Eloquent
     * Collections/Paginators survive a real Redis round-trip intact.
     */
    public function test_catalog_cache_survives_a_real_redis_round_trip(): void
    {
        $originalDefault = Config::get('cache.default');
        Config::set('cache.default', 'redis');
        Cache::forgetDriver('redis');
        Cache::tags(['catalog'])->flush();

        try {
            $manager = $this->inventoryManager();
            Category::factory()->count(2)->create();

            $this->actingAs($manager)
                ->get('/catalog/categories')
                ->assertOk()
                ->assertInertia(fn (Assert $page) => $page->has('categories', 2));

            // Second request is a real cache hit against Redis.
            $this->actingAs($manager)
                ->get('/catalog/categories')
                ->assertOk()
                ->assertInertia(fn (Assert $page) => $page->has('categories', 2));
        } finally {
            Cache::tags(['catalog'])->flush();
            Config::set('cache.default', $originalDefault);
            Cache::forgetDriver('redis');
        }
    }
}
