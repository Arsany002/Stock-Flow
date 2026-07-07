<?php

namespace Tests\Feature\Catalog;

use App\Enums\UserRole;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Proves requirement #6: a Vendor may manage price list items only for
 * their own products (Enterprise PRD §3, pricelist.manage "own" cell).
 */
class PriceListItemOwnershipTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    private function vendor(): array
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::VendorSupplier->value);
        $supplier = Supplier::factory()->create(['user_id' => $user->id]);
        $product = Product::factory()->create(['supplier_id' => $supplier->id]);

        return [$user, $supplier, $product];
    }

    public function test_vendor_can_update_their_own_price_list_item(): void
    {
        [$vendorA, , $productA] = $this->vendor();
        $priceList = PriceList::factory()->create();
        $item = PriceListItem::factory()->create([
            'price_list_id' => $priceList->id,
            'product_id' => $productA->id,
            'unit_price' => 10,
        ]);

        $response = $this->actingAs($vendorA)->put("/catalog/price-list-items/{$item->id}", [
            'unit_price' => 25.50,
            'min_qty' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('price_list_items', ['id' => $item->id, 'unit_price' => 25.50]);
    }

    public function test_vendor_cannot_edit_another_vendors_price_list_item(): void
    {
        [$vendorA] = $this->vendor();
        [, , $productB] = $this->vendor();

        $priceList = PriceList::factory()->create();
        $itemB = PriceListItem::factory()->create([
            'price_list_id' => $priceList->id,
            'product_id' => $productB->id,
            'unit_price' => 10,
        ]);

        $response = $this->actingAs($vendorA)->put("/catalog/price-list-items/{$itemB->id}", [
            'unit_price' => 999,
            'min_qty' => 1,
        ]);

        $response->assertForbidden();
        $this->assertDatabaseHas('price_list_items', ['id' => $itemB->id, 'unit_price' => 10]);
    }

    public function test_vendor_cannot_delete_another_vendors_price_list_item(): void
    {
        [$vendorA] = $this->vendor();
        [, , $productB] = $this->vendor();

        $priceList = PriceList::factory()->create();
        $itemB = PriceListItem::factory()->create([
            'price_list_id' => $priceList->id,
            'product_id' => $productB->id,
        ]);

        $response = $this->actingAs($vendorA)->delete("/catalog/price-list-items/{$itemB->id}");

        $response->assertForbidden();
        $this->assertDatabaseHas('price_list_items', ['id' => $itemB->id]);
    }

    public function test_vendor_cannot_add_an_item_for_another_vendors_product(): void
    {
        [$vendorA] = $this->vendor();
        [, , $productB] = $this->vendor();

        $priceList = PriceList::factory()->create();

        $response = $this->actingAs($vendorA)->post("/catalog/price-lists/{$priceList->id}/items", [
            'product_id' => $productB->id,
            'unit_price' => 15,
            'min_qty' => 1,
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('price_list_items', ['product_id' => $productB->id]);
    }

    public function test_inventory_manager_can_edit_any_price_list_item(): void
    {
        [, , $product] = $this->vendor();

        $manager = User::factory()->create();
        $manager->addRole(UserRole::InventoryManager->value);

        $priceList = PriceList::factory()->create();
        $item = PriceListItem::factory()->create([
            'price_list_id' => $priceList->id,
            'product_id' => $product->id,
            'unit_price' => 10,
        ]);

        $response = $this->actingAs($manager)->put("/catalog/price-list-items/{$item->id}", [
            'unit_price' => 42,
            'min_qty' => 1,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('price_list_items', ['id' => $item->id, 'unit_price' => 42]);
    }
}
