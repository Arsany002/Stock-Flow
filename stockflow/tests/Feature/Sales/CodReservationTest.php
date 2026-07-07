<?php

namespace Tests\Feature\Sales;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Services\OrderService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * Scenario 5: COD keeps reservation until delivery confirmation.
 */
class CodReservationTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_cod_keeps_reservation_until_delivery_confirmation(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);

        $order = app(OrderService::class)->checkout($customer, [
            ['product_id' => $product->id, 'quantity' => 3],
        ], PaymentMethod::Cod);

        // Checkout alone must NOT confirm the sale — reservation stays intact.
        $this->assertSame(OrderStatus::Reserved, $order->status);
        $payment = $order->payments()->latest()->first();
        $this->assertSame(PaymentStatus::Pending, $payment->status);

        $stock = app(StockService::class);
        $level = $stock->reconcile($product, $warehouse)->first();
        $this->assertSame(10, $level['on_hand']);
        $this->assertSame(3, $level['reserved']);

        // Staff confirms delivery/settles the COD payment...
        $staff = $this->salesCashier();
        $this->actingAs($staff)->post("/payments/{$payment->id}/settle")->assertRedirect();

        // ...only now does the reservation convert to a completed sale.
        $order->refresh();
        $this->assertSame(OrderStatus::Confirmed, $order->status);

        $level = $stock->reconcile($product, $warehouse)->first();
        $this->assertSame(7, $level['on_hand']);
        $this->assertSame(0, $level['reserved']);
    }

    public function test_retail_customer_cannot_settle_their_own_cod_payment(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock();

        $order = app(OrderService::class)->checkout($customer, [
            ['product_id' => $product->id, 'quantity' => 1],
        ], PaymentMethod::Cod);

        $payment = $order->payments()->latest()->first();

        $this->actingAs($customer)->post("/payments/{$payment->id}/settle")->assertForbidden();
    }
}
