<?php

namespace Tests\Feature\Procurement;

use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;

/**
 * Scenario 9: Business Buyer cannot view another account's PO.
 */
class PurchaseOrderAuthorizationTest extends TestCase
{
    use RefreshDatabase, SetsUpProcurementFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_business_buyer_cannot_view_another_account_purchase_order(): void
    {
        [$ownerBuyer, $ownerAccount] = $this->businessBuyer();
        [$strangerBuyer] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();

        $quote = app(QuoteService::class)->request($ownerAccount, [
            ['product_id' => $product->id, 'quantity' => 1],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '50.00']);
        $purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $ownerBuyer);

        $this->actingAs($strangerBuyer)->get("/procurement/purchase-orders/{$purchaseOrder->id}")->assertForbidden();
        $this->actingAs($ownerBuyer)->get("/procurement/purchase-orders/{$purchaseOrder->id}")->assertOk();
    }

    public function test_business_buyer_cannot_view_another_account_quote(): void
    {
        [, $ownerAccount] = $this->businessBuyer();
        [$strangerBuyer] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();

        $quote = app(QuoteService::class)->request($ownerAccount, [
            ['product_id' => $product->id, 'quantity' => 1],
        ]);

        $this->actingAs($strangerBuyer)->get("/procurement/quotes/{$quote->id}")->assertForbidden();
    }

    public function test_staff_with_po_approve_can_view_any_purchase_order(): void
    {
        [$ownerBuyer, $ownerAccount] = $this->businessBuyer();
        $approver = $this->inventoryManager();
        ['product' => $product] = $this->productWithStock();

        $quote = app(QuoteService::class)->request($ownerAccount, [
            ['product_id' => $product->id, 'quantity' => 1],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '50.00']);
        $purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $ownerBuyer);

        $this->actingAs($approver)->get("/procurement/purchase-orders/{$purchaseOrder->id}")->assertOk();
    }
}
