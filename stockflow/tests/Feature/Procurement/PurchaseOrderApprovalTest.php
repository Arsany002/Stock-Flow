<?php

namespace Tests\Feature\Procurement;

use App\Enums\ApprovalDecision;
use App\Enums\PurchaseOrderStatus;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Warehouse;
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;

/**
 * Scenarios 5–8 of the B2B procurement module.
 */
class PurchaseOrderApprovalTest extends TestCase
{
    use RefreshDatabase, SetsUpProcurementFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    /**
     * @return array{purchaseOrder: PurchaseOrder, product: Product, warehouse: Warehouse}
     */
    private function pendingPurchaseOrder(string $creditLimit = '100000.00', int $stockQuantity = 10, int $orderQuantity = 4): array
    {
        [$buyer, $account] = $this->businessBuyer(creditLimit: $creditLimit);
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithStock(quantity: $stockQuantity);

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $product->id, 'quantity' => $orderQuantity],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '100.00']);
        $purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $buyer);

        return ['purchaseOrder' => $purchaseOrder, 'product' => $product, 'warehouse' => $warehouse];
    }

    public function test_approver_can_approve_if_credit_is_enough(): void
    {
        ['purchaseOrder' => $purchaseOrder] = $this->pendingPurchaseOrder();
        $approver = $this->inventoryManager();

        $response = $this->actingAs($approver)->post("/procurement/purchase-orders/{$purchaseOrder->id}/approve", [
            'note' => 'Looks good.',
        ]);

        $response->assertRedirect("/procurement/purchase-orders/{$purchaseOrder->id}");

        $purchaseOrder->refresh();
        $this->assertSame(PurchaseOrderStatus::Approved, $purchaseOrder->status);
        $this->assertCount(1, $purchaseOrder->approvals);
        $this->assertSame(ApprovalDecision::Approved, $purchaseOrder->approvals->first()->decision);
    }

    public function test_approval_reserves_stock(): void
    {
        ['purchaseOrder' => $purchaseOrder, 'product' => $product, 'warehouse' => $warehouse] = $this->pendingPurchaseOrder(
            stockQuantity: 10,
            orderQuantity: 4,
        );
        $approver = $this->inventoryManager();

        $this->actingAs($approver)->post("/procurement/purchase-orders/{$purchaseOrder->id}/approve");

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(10, $level['on_hand']);
        $this->assertSame(4, $level['reserved']);
        $this->assertTrue($level['reserved_matches']);

        // subtotal 4*100=400.00, +14% VAT = 456.00 total, which is what
        // gets added to outstanding_balance on approval.
        $account = $purchaseOrder->businessAccount->fresh();
        $this->assertSame('456.00', $account->outstanding_balance);
    }

    public function test_approval_fails_if_credit_limit_exceeded(): void
    {
        // Credit limit of 100 can't absorb a PO with a total well over it.
        ['purchaseOrder' => $purchaseOrder, 'product' => $product, 'warehouse' => $warehouse] = $this->pendingPurchaseOrder(
            creditLimit: '100.00',
            stockQuantity: 10,
            orderQuantity: 4,
        );
        $approver = $this->inventoryManager();

        $response = $this->actingAs($approver)->post("/procurement/purchase-orders/{$purchaseOrder->id}/approve");

        $response->assertRedirect();
        $response->assertSessionHas('flash.error');

        $purchaseOrder->refresh();
        $this->assertSame(PurchaseOrderStatus::PendingApproval, $purchaseOrder->status);
        $this->assertCount(0, $purchaseOrder->approvals);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(0, $level['reserved']);
    }

    public function test_rejected_purchase_order_does_not_reserve_stock(): void
    {
        ['purchaseOrder' => $purchaseOrder, 'product' => $product, 'warehouse' => $warehouse] = $this->pendingPurchaseOrder();
        $approver = $this->inventoryManager();

        $response = $this->actingAs($approver)->post("/procurement/purchase-orders/{$purchaseOrder->id}/reject", [
            'note' => 'Not viable right now.',
        ]);

        $response->assertRedirect("/procurement/purchase-orders/{$purchaseOrder->id}");

        $purchaseOrder->refresh();
        $this->assertSame(PurchaseOrderStatus::Rejected, $purchaseOrder->status);
        $this->assertSame(ApprovalDecision::Rejected, $purchaseOrder->approvals->first()->decision);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(0, $level['reserved']);

        $account = $purchaseOrder->businessAccount->fresh();
        $this->assertSame('0.00', $account->outstanding_balance);
    }

    public function test_sales_cashier_cannot_approve_a_purchase_order(): void
    {
        ['purchaseOrder' => $purchaseOrder] = $this->pendingPurchaseOrder();
        $cashier = $this->salesCashier();

        $this->actingAs($cashier)->post("/procurement/purchase-orders/{$purchaseOrder->id}/approve")
            ->assertForbidden();
    }
}
