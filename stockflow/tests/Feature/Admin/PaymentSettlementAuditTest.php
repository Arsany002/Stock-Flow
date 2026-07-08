<?php

namespace Tests\Feature\Admin;

use App\Enums\PaymentMethod;
use App\Services\OrderService;
use App\Services\PaymentService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

class PaymentSettlementAuditTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_payment_settlement_is_audited(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);

        $order = app(OrderService::class)->checkout($customer, [
            ['product_id' => $product->id, 'quantity' => 2],
        ], PaymentMethod::Cod);

        $payment = $order->payments()->latest()->first();
        $staff = $this->salesCashier();

        app(PaymentService::class)->settleManually($payment, $staff);

        $this->assertDatabaseHas('activity_log', [
            'event' => 'payment.settled',
            'causer_id' => $staff->id,
            'subject_type' => 'App\\Models\\Payment',
            'subject_id' => $payment->id,
        ]);
    }
}
