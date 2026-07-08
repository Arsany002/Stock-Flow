<?php

namespace Tests\Feature\Storefront;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * Guest storefront browsing: home, listing, search, category filter,
 * product detail — no auth required anywhere in this file. See the
 * storefront requirements' Guest rules #1-#7 and Product visibility
 * rules #1-#2.
 */
class PublicBrowsingTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    public function test_guest_can_view_home_page(): void
    {
        ['product' => $product] = $this->productWithRetailStock();

        $this->get('/')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Storefront/Home')
                ->has('featuredProducts', 1)
                ->where('featuredProducts.0.sku', $product->sku)
            );
    }

    public function test_guest_can_view_public_product_listing(): void
    {
        $this->productWithRetailStock();
        $this->productWithRetailStock();

        $this->get('/products')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Storefront/Products/Index')
                ->has('products.data', 2)
            );
    }

    public function test_guest_can_search_products(): void
    {
        $product = Product::factory()->create(['name' => 'Wireless Mouse']);
        Product::factory()->create(['name' => 'Desk Lamp']);

        $this->get('/search?q=Wireless')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Storefront/Search')
                ->has('products.data', 1)
                ->where('products.data.0.sku', $product->sku)
            );
    }

    public function test_guest_can_filter_products_by_category(): void
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create();

        $productA = Product::factory()->create(['category_id' => $categoryA->id]);
        Product::factory()->create(['category_id' => $categoryB->id]);

        $this->get("/categories/{$categoryA->slug}")
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Storefront/Categories/Show')
                ->has('products.data', 1)
                ->where('products.data.0.sku', $productA->sku)
            );
    }

    public function test_guest_can_view_active_product_detail_by_sku(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 50, price: '49.99');

        $this->get("/products/{$product->sku}")
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Storefront/Products/Show')
                ->where('product.sku', $product->sku)
                ->where('product.price', '49.99')
                ->where('product.stock_status', 'in_stock')
                ->missing('product.quantity')
                ->missing('product.on_hand')
                ->missing('product.available')
            );
    }

    public function test_inactive_product_is_not_visible_in_public_listing(): void
    {
        Product::factory()->create(['is_active' => false]);

        $this->get('/products')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->has('products.data', 0));
    }

    public function test_guest_cannot_view_inactive_product_detail(): void
    {
        $product = Product::factory()->create(['is_active' => false]);

        $this->get("/products/{$product->sku}")->assertNotFound();
    }

    public function test_guest_cannot_view_nonexistent_product_detail(): void
    {
        $this->get('/products/NO-SUCH-SKU')->assertNotFound();
    }
}
