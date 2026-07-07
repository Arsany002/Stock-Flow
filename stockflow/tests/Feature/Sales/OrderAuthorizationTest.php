<?php

namespace Tests\Feature\Sales;

use App\Enums\PaymentMethod;
use App\Services\OrderService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * Scenario 4: unauthorized customer cannot view another customer's order.
 */
class OrderAuthorizationTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_unauthorized_customer_cannot_view_another_customer_order(): void
    {
        $owner = $this->retailCustomer();
        $stranger = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock();

        $order = app(OrderService::class)->checkout($owner, [
            ['product_id' => $product->id, 'quantity' => 1],
        ], PaymentMethod::Cod);

        $this->actingAs($stranger)->get("/orders/{$order->id}")->assertForbidden();
        $this->actingAs($owner)->get("/orders/{$order->id}")->assertOk();
    }

    public function test_staff_with_payment_settle_can_view_any_order(): void
    {
        $owner = $this->retailCustomer();
        $staff = $this->salesCashier();
        ['product' => $product] = $this->productWithRetailStock();

        $order = app(OrderService::class)->checkout($owner, [
            ['product_id' => $product->id, 'quantity' => 1],
        ], PaymentMethod::Cod);

        $this->actingAs($staff)->get("/orders/{$order->id}")->assertOk();
    }

    public function test_guest_cannot_view_orders_index(): void
    {
        $this->get('/orders')->assertRedirect('/login');
    }
}
