<?php

namespace Tests\Feature\Catalog;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductManagementTest extends TestCase
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

    public function test_authorized_user_can_create_a_product(): void
    {
        $manager = $this->inventoryManager();
        $category = Category::factory()->create();

        $response = $this->actingAs($manager)->post('/catalog/products', [
            'category_id' => $category->id,
            'sku' => 'SKU-NEW-001',
            'name' => 'New Widget',
            'description' => 'A widget.',
            'is_active' => true,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['sku' => 'SKU-NEW-001', 'name' => 'New Widget']);
    }

    public function test_authorized_user_can_update_a_product(): void
    {
        $manager = $this->inventoryManager();
        $product = Product::factory()->create(['name' => 'Old Name']);

        $response = $this->actingAs($manager)->put("/catalog/products/{$product->id}", [
            'category_id' => $product->category_id,
            'supplier_id' => $product->supplier_id,
            'sku' => $product->sku,
            'name' => 'Updated Name',
            'is_active' => true,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Updated Name']);
    }

    public function test_unauthorized_user_gets_403_creating_a_product(): void
    {
        $retail = User::factory()->create();
        $retail->addRole(UserRole::RetailCustomer->value);
        $category = Category::factory()->create();

        $response = $this->actingAs($retail)->post('/catalog/products', [
            'category_id' => $category->id,
            'sku' => 'SKU-BLOCKED-001',
            'name' => 'Blocked Widget',
            'is_active' => true,
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('products', ['sku' => 'SKU-BLOCKED-001']);
    }

    public function test_unauthorized_user_gets_403_viewing_product_create_page(): void
    {
        $retail = User::factory()->create();
        $retail->addRole(UserRole::RetailCustomer->value);

        $this->actingAs($retail)->get('/catalog/products/create')->assertForbidden();
    }

    public function test_product_sku_must_be_unique_on_create(): void
    {
        $manager = $this->inventoryManager();
        $existing = Product::factory()->create(['sku' => 'SKU-DUPLICATE']);
        $category = Category::factory()->create();

        $response = $this->actingAs($manager)->post('/catalog/products', [
            'category_id' => $category->id,
            'sku' => 'SKU-DUPLICATE',
            'name' => 'Another Widget',
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors('sku');
        $this->assertSame(1, Product::query()->where('sku', 'SKU-DUPLICATE')->count());
    }

    public function test_product_sku_must_be_unique_on_update_excluding_itself(): void
    {
        $manager = $this->inventoryManager();
        $productA = Product::factory()->create(['sku' => 'SKU-A']);
        $productB = Product::factory()->create(['sku' => 'SKU-B']);

        // Updating A with its own (unchanged) SKU must succeed.
        $this->actingAs($manager)->put("/catalog/products/{$productA->id}", [
            'category_id' => $productA->category_id,
            'sku' => 'SKU-A',
            'name' => $productA->name,
            'is_active' => true,
        ])->assertRedirect();

        // Updating A to collide with B's SKU must fail.
        $response = $this->actingAs($manager)->put("/catalog/products/{$productA->id}", [
            'category_id' => $productA->category_id,
            'sku' => 'SKU-B',
            'name' => $productA->name,
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors('sku');
    }
}
