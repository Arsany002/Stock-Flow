<?php

namespace Tests\Feature\Storefront;

use App\Models\Order;
use App\Models\Product;
use App\Models\StockMovement;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * Guest session cart: add/update/remove, persistence, and the "never
 * reserves stock, never writes anything but the session" invariant. See
 * the storefront requirements' Guest rules #8-#17 and Cart rules #1-#10.
 */
class GuestCartTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_guest_can_add_active_in_stock_product_to_session_cart(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10, price: '25.00');

        $response = $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2]);

        $response->assertRedirect('/cart');
        $response->assertSessionHas('flash.success');

        $this->get('/cart')->assertInertia(fn (Assert $page) => $page
            ->component('Storefront/Cart/Show')
            ->has('lines', 1)
            ->where('lines.0.quantity', 2)
            ->where('subtotal', '50.00')
        );
    }

    public function test_guest_cannot_add_inactive_product_to_cart(): void
    {
        $product = Product::factory()->create(['is_active' => false]);

        $response = $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error');

        $this->get('/cart')->assertInertia(fn (Assert $page) => $page->has('lines', 0));
    }

    public function test_guest_cannot_add_out_of_stock_product_to_cart(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 0);

        $response = $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error');

        $this->get('/cart')->assertInertia(fn (Assert $page) => $page->has('lines', 0));
    }

    public function test_guest_cannot_add_quantity_greater_than_available(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 2);

        $response = $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 3]);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error', 'Requested quantity is not available.');

        $this->get('/cart')->assertInertia(fn (Assert $page) => $page->has('lines', 0));
    }

    public function test_guest_cannot_update_cart_quantity_greater_than_available(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 2);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $response = $this->patch("/cart/items/{$product->id}", ['quantity' => 3]);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error', 'Requested quantity is not available.');

        $this->get('/cart')->assertInertia(fn (Assert $page) => $page->where('lines.0.quantity', 1));
    }

    public function test_quantity_error_message_does_not_expose_exact_available_stock(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 2);

        $response = $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 3]);
        $message = $response->baseResponse->getSession()->get('flash.error');

        $this->assertSame('Requested quantity is not available.', $message);
        $this->assertStringNotContainsString('2', $message);
        $this->assertStringNotContainsString($product->id, $message);
    }

    public function test_guest_can_update_cart_quantity(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $response = $this->patch("/cart/items/{$product->id}", ['quantity' => 4]);

        $response->assertRedirect('/cart');
        $this->get('/cart')->assertInertia(fn (Assert $page) => $page->where('lines.0.quantity', 4));
    }

    public function test_guest_can_remove_cart_item(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $response = $this->delete("/cart/items/{$product->id}");

        $response->assertRedirect('/cart');
        $this->get('/cart')->assertInertia(fn (Assert $page) => $page->has('lines', 0));
    }

    public function test_guest_can_clear_the_whole_cart(): void
    {
        ['product' => $productA] = $this->productWithRetailStock(quantity: 10);
        ['product' => $productB] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $productA->id, 'quantity' => 1]);
        $this->post('/cart/items', ['product_id' => $productB->id, 'quantity' => 1]);

        $response = $this->delete('/cart');

        $response->assertRedirect('/cart');
        $this->get('/cart')->assertInertia(fn (Assert $page) => $page->has('lines', 0));
    }

    public function test_guest_cart_persists_across_requests_in_session(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);

        // Reuse the same session across requests (default TestCase behavior
        // keeps cookies within one test), simulating a guest browsing
        // multiple pages without logging in.
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 3]);

        $this->get('/products')->assertInertia(fn (Assert $page) => $page->where('cart.count', 3));
        $this->get('/cart')->assertInertia(fn (Assert $page) => $page->where('lines.0.quantity', 3));
    }

    public function test_cart_count_is_shared_with_every_inertia_response(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2]);

        $this->get('/')->assertInertia(fn (Assert $page) => $page->where('cart.count', 2));
    }

    public function test_guest_cart_remains_available_after_login(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $customer = $this->retailCustomer();

        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2]);

        $this->actingAs($customer)
            ->get('/cart')
            ->assertInertia(fn (Assert $page) => $page->has('lines', 1)->where('lines.0.quantity', 2));
    }

    public function test_guest_cart_remains_available_after_registration(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);

        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2]);

        $this->post('/register', [
            'name' => 'New Customer',
            'email' => 'new-customer@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect('/checkout');

        $this->assertAuthenticated();
        $this->get('/cart')
            ->assertInertia(fn (Assert $page) => $page->has('lines', 1)->where('lines.0.quantity', 2));
    }

    public function test_guest_redirected_from_checkout_can_register_and_access_checkout_with_cart(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);

        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);
        $this->get('/checkout')->assertRedirect('/login');

        $this->post('/register', [
            'name' => 'Checkout Customer',
            'email' => 'checkout-customer@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertRedirect('/checkout');

        $this->assertAuthenticated();
        $this->get('/checkout')->assertOk();
    }

    public function test_checkout_still_revalidates_stock_after_valid_cart_add(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 2);

        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2])
            ->assertRedirect('/cart');

        app(StockService::class)->adjust($product, $warehouse, -2, null, 'Sold before checkout.');

        $ordersBefore = Order::query()->count();
        $movementsBefore = StockMovement::query()->count();

        $response = $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error');
        $this->assertSame($ordersBefore, Order::query()->count());
        $this->assertSame($movementsBefore, StockMovement::query()->count());
    }
}
