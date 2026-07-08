<?php

namespace Tests\Feature\Storefront;

use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use App\Services\CatalogService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

/**
 * Public product/category listings are cached under the same 'catalog' tag
 * CatalogService already uses (StorefrontCatalogService reuses
 * CatalogService::listCategories() directly for categories, and shares the
 * tag for its own product-listing cache keys) — so a write through the
 * existing admin CatalogService flushes both. See docs/technical/cache.md
 * and the storefront requirements' Caching rules #1-#3.
 */
class StorefrontCacheTest extends TestCase
{
    use RefreshDatabase;

    private function inventoryManager(): User
    {
        $this->seed(RolePermissionSeeder::class);
        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);

        return $user;
    }

    public function test_public_product_cache_invalidates_after_product_update(): void
    {
        $manager = $this->inventoryManager();
        $product = Product::factory()->create(['name' => 'Original Name']);

        $this->get('/products')->assertInertia(fn (Assert $page) => $page
            ->where('products.data.0.name', 'Original Name')
        );

        $this->actingAs($manager)->put("/catalog/products/{$product->id}", [
            'category_id' => $product->category_id,
            'sku' => $product->sku,
            'name' => 'Updated Name',
            'is_active' => true,
        ])->assertRedirect();

        $this->get('/products')->assertInertia(fn (Assert $page) => $page
            ->where('products.data.0.name', 'Updated Name')
        );
    }

    public function test_public_category_cache_invalidates_after_category_creation(): void
    {
        // publicCategories is shared on every Inertia response — warm the
        // cache with the pre-creation (empty) state first.
        $this->get('/')->assertInertia(fn (Assert $page) => $page->has('publicCategories', 0));

        app(CatalogService::class)->createCategory(['name' => 'New Category', 'slug' => 'new-category']);

        $this->get('/')->assertInertia(fn (Assert $page) => $page
            ->has('publicCategories', 1)
            ->where('publicCategories.0.name', 'New Category')
        );
    }
}
