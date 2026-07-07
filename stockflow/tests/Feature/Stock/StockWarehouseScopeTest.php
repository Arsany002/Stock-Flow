<?php

namespace Tests\Feature\Stock;

use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Proves warehouse-team scoping (docs/project/canonical-decisions.md §3):
 * an Inventory Manager assigned to one warehouse's Laratrust team cannot
 * move stock in a warehouse outside that team, at both layers that enforce
 * it — the FormRequest's policy check and WarehouseScopeMiddleware.
 */
class StockWarehouseScopeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_inventory_manager_cannot_move_stock_outside_assigned_warehouse_team(): void
    {
        $ownWarehouse = Warehouse::factory()->create();
        $otherWarehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();

        $manager = User::factory()->create();
        $manager->addRole(UserRole::InventoryManager->value, $ownWarehouse->fresh()->team);

        $response = $this->actingAs($manager)->post('/stock/adjustments', [
            'product_id' => $product->id,
            'warehouse_id' => $otherWarehouse->id,
            'quantity' => 5,
            'reason' => 'Attempted cross-warehouse adjustment',
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $otherWarehouse->id,
        ]);
    }

    public function test_inventory_manager_can_move_stock_inside_assigned_warehouse_team(): void
    {
        $ownWarehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();

        $manager = User::factory()->create();
        $manager->addRole(UserRole::InventoryManager->value, $ownWarehouse->fresh()->team);

        $response = $this->actingAs($manager)->post('/stock/adjustments', [
            'product_id' => $product->id,
            'warehouse_id' => $ownWarehouse->id,
            'quantity' => 5,
            'reason' => 'In-scope adjustment',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $ownWarehouse->id,
            'quantity' => 5,
        ]);
    }

    public function test_super_admin_can_move_stock_in_any_warehouse(): void
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();

        $admin = User::factory()->create();
        $admin->addRole(UserRole::SuperAdmin->value);

        $response = $this->actingAs($admin)->post('/stock/adjustments', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 5,
            'reason' => 'Super admin override',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 5,
        ]);
    }
}
