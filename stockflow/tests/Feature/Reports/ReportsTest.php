<?php

namespace Tests\Feature\Reports;

use App\Enums\PaymentMethod;
use App\Enums\UserRole;
use App\Models\User;
use App\Services\OrderService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * Modules 5–9: five reports. Requirement #4 (paginated), #7 (route
 * protection), and basic rendering for each.
 */
class ReportsTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    private function inventoryManager(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);

        return $user;
    }

    // --- Low stock report -------------------------------------------------

    public function test_stock_read_holder_can_view_low_stock_report(): void
    {
        $manager = $this->inventoryManager();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 3);

        $response = $this->actingAs($manager)->get('/reports/low-stock?threshold=10');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Reports/LowStock')
            ->has('levels.data', 1)
            ->where('levels.data.0.product.id', $product->id)
            ->where('levels.data.0.warehouse.id', $warehouse->id)
        );
    }

    public function test_unauthorized_user_cannot_view_low_stock_report(): void
    {
        $customer = $this->retailCustomer();

        $this->actingAs($customer)->get('/reports/low-stock')->assertForbidden();
    }

    // --- Stock movement report --------------------------------------------

    public function test_stock_movement_report_renders_and_is_paginated(): void
    {
        $manager = $this->inventoryManager();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithRetailStock(quantity: 0);

        foreach (range(1, 3) as $i) {
            app(StockService::class)->purchaseIn($product, $warehouse, 5, $manager, null);
        }

        $response = $this->actingAs($manager)->get('/reports/stock-movements');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Reports/StockMovements')
            ->has('movements.data', 3)
            ->has('movements.links')
        );
    }

    public function test_unauthorized_user_cannot_view_stock_movement_report(): void
    {
        $customer = $this->retailCustomer();

        $this->actingAs($customer)->get('/reports/stock-movements')->assertForbidden();
    }

    // --- Sales report -------------------------------------------------

    public function test_payment_settle_holder_can_view_sales_report(): void
    {
        $staff = $this->salesCashier();
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 5);

        app(OrderService::class)->checkout($customer, [
            ['product_id' => $product->id, 'quantity' => 1],
        ], PaymentMethod::Cod);

        $response = $this->actingAs($staff)->get('/reports/sales');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Reports/Sales')
            ->has('orders.data', 1)
        );
    }

    public function test_unauthorized_user_cannot_view_sales_report(): void
    {
        $customer = $this->retailCustomer();

        $this->actingAs($customer)->get('/reports/sales')->assertForbidden();
    }

    // --- Payments report -------------------------------------------------

    public function test_payment_settle_holder_can_view_payments_report(): void
    {
        $staff = $this->salesCashier();
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 5);

        app(OrderService::class)->checkout($customer, [
            ['product_id' => $product->id, 'quantity' => 1],
        ], PaymentMethod::Cod);

        $response = $this->actingAs($staff)->get('/reports/payments');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Reports/Payments')
            ->has('payments.data', 1)
        );
    }

    public function test_payments_report_filters_by_status(): void
    {
        $staff = $this->salesCashier();
        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 5);

        app(OrderService::class)->checkout($customer, [
            ['product_id' => $product->id, 'quantity' => 1],
        ], PaymentMethod::Cod);

        $response = $this->actingAs($staff)->get('/reports/payments?status=paid');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Reports/Payments')
            ->has('payments.data', 0)
        );
    }

    public function test_unauthorized_user_cannot_view_payments_report(): void
    {
        $customer = $this->retailCustomer();

        $this->actingAs($customer)->get('/reports/payments')->assertForbidden();
    }

    // --- Imports report -------------------------------------------------

    public function test_import_run_holder_can_view_imports_report(): void
    {
        $manager = $this->inventoryManager();

        $response = $this->actingAs($manager)->get('/reports/imports');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page->component('Reports/Imports'));
    }

    public function test_unauthorized_user_cannot_view_imports_report(): void
    {
        $customer = $this->retailCustomer();

        $this->actingAs($customer)->get('/reports/imports')->assertForbidden();
    }
}
