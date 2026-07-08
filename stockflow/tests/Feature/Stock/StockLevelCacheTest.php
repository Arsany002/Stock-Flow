<?php

namespace Tests\Feature\Stock;

use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

/**
 * Proves requirement #3 of the hardening pass: stock level reads
 * (Stock/Levels index — StockService::listLevels()) are cached, and every
 * stock movement flushes that cache so the next read is never stale. See
 * docs/technical/cache.md §"Stock levels — cached carefully".
 */
class StockLevelCacheTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_stock_level_cache_invalidates_after_a_stock_movement(): void
    {
        $manager = $this->inventoryManager();
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();

        app(StockService::class)->purchaseIn($product, $warehouse, 10, $manager, null);

        $query = "/stock/levels?product_id={$product->id}&warehouse_id={$warehouse->id}";

        // Warm the cache with the pre-movement on_hand value.
        $this->actingAs($manager)->get($query)
            ->assertInertia(fn (Assert $page) => $page->where('levels.data.0.on_hand', 10));

        app(StockService::class)->purchaseIn($product, $warehouse, 5, $manager, null);

        // If the cache had not been flushed by the second purchaseIn(),
        // this would still report 10.
        $this->actingAs($manager)->get($query)
            ->assertInertia(fn (Assert $page) => $page->where('levels.data.0.on_hand', 15));
    }

    public function test_stock_level_cache_invalidates_after_an_adjustment(): void
    {
        // SuperAdmin, not Inventory Manager — WarehouseScopeMiddleware
        // requires an Inventory Manager to be team-scoped to the specific
        // warehouse, which isn't this test's concern (see
        // StockWarehouseScopeTest for that).
        $admin = User::factory()->create();
        $admin->addRole(UserRole::SuperAdmin->value);
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();

        app(StockService::class)->purchaseIn($product, $warehouse, 20, $admin, null);

        $query = "/stock/levels?product_id={$product->id}&warehouse_id={$warehouse->id}";

        $this->actingAs($admin)->get($query)
            ->assertInertia(fn (Assert $page) => $page->where('levels.data.0.on_hand', 20));

        $this->actingAs($admin)->post('/stock/adjustments', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => -5,
            'reason' => 'Damaged in warehouse',
        ])->assertRedirect();

        $this->actingAs($admin)->get($query)
            ->assertInertia(fn (Assert $page) => $page->where('levels.data.0.on_hand', 15));
    }
}
