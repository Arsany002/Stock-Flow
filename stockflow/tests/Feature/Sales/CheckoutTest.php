<?php

namespace Tests\Feature\Sales;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StockMovement;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * Scenarios 1, 2, 3, 6, 7 of the B2C checkout module.
 */
class CheckoutTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_customer_can_checkout(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 10, price: '100.00');

        $this->actingAs($customer)->post('/cart', ['product_id' => $product->id, 'quantity' => 2])
            ->assertRedirect();

        $response = $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);

        $order = Order::query()->where('user_id', $customer->id)->firstOrFail();
        $response->assertRedirect("/orders/{$order->id}");

        $this->assertSame(OrderStatus::Reserved, $order->status);
        $this->assertNotNull($order->reserved_until);
        // subtotal 200.00, VAT 14% = 28.00, total 228.00
        $this->assertSame('200.00', $order->subtotal);
        $this->assertSame('28.00', $order->tax);
        $this->assertSame('228.00', $order->total);
    }

    public function test_checkout_reserves_all_lines(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $productA, 'warehouse' => $warehouseA] = $this->productWithRetailStock(quantity: 10);
        ['product' => $productB, 'warehouse' => $warehouseB] = $this->productWithRetailStock(quantity: 5);

        $this->actingAs($customer)->post('/cart', ['product_id' => $productA->id, 'quantity' => 3]);
        $this->actingAs($customer)->post('/cart', ['product_id' => $productB->id, 'quantity' => 2]);
        $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);

        $order = Order::query()->where('user_id', $customer->id)->firstOrFail();
        $this->assertCount(2, $order->items);

        $stock = app(StockService::class);

        $levelA = $stock->reconcile($productA, $warehouseA)->first();
        $this->assertSame(3, $levelA['reserved']);
        $this->assertTrue($levelA['reserved_matches']);

        $levelB = $stock->reconcile($productB, $warehouseB)->first();
        $this->assertSame(2, $levelB['reserved']);
        $this->assertTrue($levelB['reserved_matches']);
    }

    public function test_partial_availability_fails_without_partial_writes(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $available] = $this->productWithRetailStock(quantity: 10);
        ['product' => $scarce] = $this->productWithRetailStock(quantity: 1);

        $this->actingAs($customer)->post('/cart', ['product_id' => $available->id, 'quantity' => 5]);
        // Requesting more than the single unit in stock.
        $this->actingAs($customer)->post('/cart', ['product_id' => $scarce->id, 'quantity' => 5]);

        $ordersBefore = Order::query()->count();
        $itemsBefore = OrderItem::query()->count();
        $movementsBefore = StockMovement::query()->count();

        $response = $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error');

        $this->assertSame($ordersBefore, Order::query()->count());
        $this->assertSame($itemsBefore, OrderItem::query()->count());
        $this->assertSame($movementsBefore, StockMovement::query()->count());
    }

    public function test_fake_payment_success_confirms_order(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);

        $this->actingAs($customer)->post('/cart', ['product_id' => $product->id, 'quantity' => 4]);
        $this->actingAs($customer)->post('/checkout', ['payment_method' => 'fake_gateway', 'outcome' => 'succeed']);

        $order = Order::query()->where('user_id', $customer->id)->firstOrFail();
        $this->assertSame(OrderStatus::Confirmed, $order->status);

        $payment = $order->payments()->latest()->first();
        $this->assertSame(PaymentStatus::Paid, $payment->status);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(6, $level['on_hand']);
        $this->assertSame(0, $level['reserved']);
        $this->assertTrue($level['on_hand_matches']);
        $this->assertTrue($level['reserved_matches']);
    }

    public function test_fake_payment_failure_does_not_confirm_order(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);

        $this->actingAs($customer)->post('/cart', ['product_id' => $product->id, 'quantity' => 4]);
        $this->actingAs($customer)->post('/checkout', ['payment_method' => 'fake_gateway', 'outcome' => 'fail']);

        $order = Order::query()->where('user_id', $customer->id)->firstOrFail();
        $this->assertSame(OrderStatus::Cancelled, $order->status);

        $payment = $order->payments()->latest()->first();
        $this->assertSame(PaymentStatus::Failed, $payment->status);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(10, $level['on_hand']);
        $this->assertSame(0, $level['reserved']);
        $this->assertTrue($level['on_hand_matches']);
        $this->assertTrue($level['reserved_matches']);
    }
}
