<?php

namespace Tests\Feature\Sales;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Services\OrderService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * Scenario 8: expired unpaid reservation releases stock.
 */
class ReservationExpiryTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_expired_unpaid_reservation_releases_stock(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 10);

        $order = app(OrderService::class)->checkout($customer, [
            ['product_id' => $product->id, 'quantity' => 4],
        ], PaymentMethod::Cod);

        $this->assertSame(OrderStatus::Reserved, $order->status);

        // Simulate time passing — reserved_until is in the past now.
        $order->forceFill(['reserved_until' => now()->subMinute()])->save();

        $this->artisan('stock:release-expired-reservations')
            ->expectsOutputToContain('Released 1 expired reservation(s).')
            ->assertExitCode(0);

        $order->refresh();
        $this->assertSame(OrderStatus::Cancelled, $order->status);

        $payment = $order->payments()->latest()->first();
        $this->assertSame(PaymentStatus::Failed, $payment->status);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(10, $level['on_hand']);
        $this->assertSame(0, $level['reserved']);
        $this->assertTrue($level['on_hand_matches']);
        $this->assertTrue($level['reserved_matches']);
    }

    public function test_non_expired_reservation_is_left_alone(): void
    {
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 10);

        $order = app(OrderService::class)->checkout($customer, [
            ['product_id' => $product->id, 'quantity' => 2],
        ], PaymentMethod::Cod);

        Artisan::call('stock:release-expired-reservations');

        $order->refresh();
        $this->assertSame(OrderStatus::Reserved, $order->status);
    }
}
