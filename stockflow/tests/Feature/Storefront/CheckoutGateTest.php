<?php

namespace Tests\Feature\Storefront;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\StockMovement;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * The /checkout auth gate: a guest must never create an order, payment, or
 * stock reservation, and must be redirected to /login with a specific
 * flash message. An authenticated Retail Customer must still be able to
 * check out normally, with the cart carried over from before login. See
 * the storefront requirements' Guest rules #12-#18 and Authenticated
 * Retail Customer rules #1-#4.
 */
class CheckoutGateTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_guest_visiting_checkout_is_redirected_to_login_with_flash_message(): void
    {
        $response = $this->get('/checkout');

        $response->assertRedirect('/login');
        $response->assertSessionHas('flash.error', 'Please log in to complete your order.');
    }

    public function test_guest_posting_to_checkout_is_redirected_to_login_without_creating_an_order(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $response = $this->post('/checkout', ['payment_method' => 'cod']);

        $response->assertRedirect('/login');
        $response->assertSessionHas('flash.error', 'Please log in to complete your order.');
    }

    public function test_guest_cannot_create_a_final_order(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $this->post('/checkout', ['payment_method' => 'cod']);

        $this->assertSame(0, Order::query()->count());
        $this->assertSame(0, OrderItem::query()->count());
    }

    public function test_guest_cannot_create_a_payment(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $this->post('/checkout', ['payment_method' => 'fake_gateway', 'outcome' => 'succeed']);

        $this->assertSame(0, Payment::query()->count());
    }

    public function test_guest_cannot_reserve_stock(): void
    {
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        // productWithRetailStock() itself writes one purchase_in movement —
        // the assertion is that checkout adds none on top of it, not that
        // the ledger is empty.
        $movementsBefore = StockMovement::query()->count();

        $this->post('/checkout', ['payment_method' => 'cod']);

        $this->assertSame($movementsBefore, StockMovement::query()->count());
    }

    public function test_authenticated_retail_customer_can_access_checkout(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $this->actingAs($customer)->get('/checkout')->assertOk();
    }

    public function test_authenticated_retail_customer_can_create_order_from_cart(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 10, price: '30.00');

        // Cart built while still a guest — the requirement is that it
        // survives the guest -> authenticated transition.
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 2]);

        $response = $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);

        $order = Order::query()->where('user_id', $customer->id)->first();
        $this->assertNotNull($order);
        $response->assertRedirect("/orders/{$order->id}");
        $this->assertSame(OrderStatus::Reserved, $order->status);
    }

    public function test_stock_reservation_happens_only_during_authenticated_checkout(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);

        // Adding to cart as a guest must not move the needle at all —
        // productWithRetailStock() itself writes one purchase_in movement,
        // so compare against that baseline rather than assuming zero.
        $movementsBefore = StockMovement::query()->count();
        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 3]);
        $this->assertSame($movementsBefore, StockMovement::query()->count());

        $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(3, $level['reserved']);
        $this->assertTrue($level['reserved_matches']);
    }
}
