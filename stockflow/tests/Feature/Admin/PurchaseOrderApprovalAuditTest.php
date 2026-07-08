<?php

namespace Tests\Feature\Admin;

use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;

class PurchaseOrderApprovalAuditTest extends TestCase
{
    use RefreshDatabase, SetsUpProcurementFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_po_approval_is_audited(): void
    {
        [$buyer, $account] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();
        $approver = $this->inventoryManager();

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $product->id, 'quantity' => 2],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '50.00']);
        $purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $buyer);

        app(PurchaseOrderService::class)->approve($purchaseOrder, $approver);

        $this->assertDatabaseHas('activity_log', [
            'event' => 'po.approved',
            'causer_id' => $approver->id,
            'subject_type' => 'App\\Models\\PurchaseOrder',
            'subject_id' => $purchaseOrder->id,
        ]);
    }

    public function test_po_rejection_is_audited(): void
    {
        [$buyer, $account] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();
        $approver = $this->inventoryManager();

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $product->id, 'quantity' => 2],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '50.00']);
        $purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $buyer);

        app(PurchaseOrderService::class)->reject($purchaseOrder, $approver, 'Not viable.');

        $this->assertDatabaseHas('activity_log', [
            'event' => 'po.rejected',
            'causer_id' => $approver->id,
            'subject_type' => 'App\\Models\\PurchaseOrder',
            'subject_id' => $purchaseOrder->id,
        ]);
    }
}
