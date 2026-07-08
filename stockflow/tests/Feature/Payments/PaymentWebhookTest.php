<?php

namespace Tests\Feature\Payments;

use App\Enums\MovementType;
use App\Enums\OrderChannel;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\StockMovement;
use App\Services\PaymentService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

class PaymentWebhookTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_fake_gateway_success_marks_payment_paid_and_confirms_order(): void
    {
        ['order' => $order, 'payment' => $payment, 'product' => $product, 'warehouse' => $warehouse] = $this->reservedOrderWithFakePayment(3);

        $this->postJson('/webhooks/v1/fake-gateway', [
            'payment_id' => $payment->id,
            'gateway_ref' => $payment->gateway_ref,
            'outcome' => 'succeed',
        ])->assertOk();

        $this->assertSame(PaymentStatus::Paid, $payment->fresh()->status);
        $this->assertSame(OrderStatus::Confirmed, $order->fresh()->status);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(7, $level['on_hand']);
        $this->assertSame(0, $level['reserved']);
    }

    public function test_fake_gateway_failure_marks_payment_failed_and_does_not_reduce_stock(): void
    {
        ['order' => $order, 'payment' => $payment, 'product' => $product, 'warehouse' => $warehouse] = $this->reservedOrderWithFakePayment(3);

        $this->postJson('/webhooks/v1/fake-gateway', [
            'payment_id' => $payment->id,
            'gateway_ref' => $payment->gateway_ref,
            'outcome' => 'fail',
        ])->assertOk();

        $this->assertSame(PaymentStatus::Failed, $payment->fresh()->status);
        $this->assertSame(OrderStatus::Cancelled, $order->fresh()->status);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(10, $level['on_hand']);
        $this->assertSame(0, $level['reserved']);
    }

    public function test_duplicate_fake_gateway_webhook_is_a_no_op(): void
    {
        ['payment' => $payment, 'product' => $product, 'warehouse' => $warehouse] = $this->reservedOrderWithFakePayment(2);

        $payload = [
            'payment_id' => $payment->id,
            'gateway_ref' => $payment->gateway_ref,
            'outcome' => 'succeed',
        ];

        $this->postJson('/webhooks/v1/fake-gateway', $payload)->assertOk();
        $saleOutCount = StockMovement::query()->where('type', MovementType::SaleOut->value)->count();

        $this->postJson('/webhooks/v1/fake-gateway', $payload)->assertOk();

        $this->assertSame($saleOutCount, StockMovement::query()->where('type', MovementType::SaleOut->value)->count());

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(8, $level['on_hand']);
        $this->assertSame(0, $level['reserved']);
    }

    public function test_gateway_ref_uniqueness_prevents_duplicate_processing(): void
    {
        Payment::factory()->create(['gateway_ref' => 'gateway-duplicate']);
        $payment = Payment::factory()->create(['gateway_ref' => null]);

        $this->expectException(QueryException::class);

        $payment->update(['gateway_ref' => 'gateway-duplicate']);
    }

    /**
     * @return array<string, mixed>
     */
    private function reservedOrderWithFakePayment(int $quantity): array
    {
        $customer = $this->retailCustomer();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);

        $subtotal = bcmul('100.00', (string) $quantity, 2);
        $tax = bcmul($subtotal, '0.14', 2);
        $total = bcadd($subtotal, $tax, 2);

        $order = Order::query()->create([
            'user_id' => $customer->id,
            'channel' => OrderChannel::B2C,
            'status' => OrderStatus::Reserved,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'reserved_until' => now()->addMinutes(30),
        ]);

        OrderItem::query()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => $quantity,
            'unit_price' => '100.00',
            'line_total' => $subtotal,
        ]);

        app(StockService::class)->reserve($product, $warehouse, $quantity, $customer, $order);

        $payment = app(PaymentService::class)->initiate($order, PaymentMethod::FakeGateway, $total);

        return compact('order', 'payment', 'product', 'warehouse');
    }
}
