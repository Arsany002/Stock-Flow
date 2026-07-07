<?php

namespace Tests\Feature\Procurement;

use App\Enums\PaymentStatus;
use App\Enums\PurchaseOrderStatus;
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;

/**
 * Scenario 10: Bank Transfer settlement converts reservation to sale_out.
 */
class BankTransferSettlementTest extends TestCase
{
    use RefreshDatabase, SetsUpProcurementFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_bank_transfer_settlement_converts_reservation_to_sale_out(): void
    {
        [$buyer, $account] = $this->businessBuyer();
        ['product' => $product, 'warehouse' => $warehouse] = $this->productWithStock(quantity: 10);

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $product->id, 'quantity' => 4],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '100.00']);
        $purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $buyer);

        $approver = $this->inventoryManager();
        app(PurchaseOrderService::class)->approve($purchaseOrder, $approver);

        // Sanity check: reserved, not yet sold, credit consumed.
        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(10, $level['on_hand']);
        $this->assertSame(4, $level['reserved']);
        $this->assertSame('456.00', $account->fresh()->outstanding_balance);

        $settler = $this->salesCashier();
        $response = $this->actingAs($settler)->post("/procurement/purchase-orders/{$purchaseOrder->id}/bank-transfer", [
            'reference' => 'TRX-12345',
        ]);

        $response->assertRedirect("/procurement/purchase-orders/{$purchaseOrder->id}");

        $purchaseOrder->refresh();
        $this->assertSame(PurchaseOrderStatus::Fulfilled, $purchaseOrder->status);

        $payment = $purchaseOrder->payments()->latest()->first();
        $this->assertSame('bank_transfer', $payment->method->value);
        $this->assertSame(PaymentStatus::Paid, $payment->status);

        // Reservation converted to a completed sale: on_hand decreases,
        // reserved returns to zero, ledger still balances.
        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(6, $level['on_hand']);
        $this->assertSame(0, $level['reserved']);
        $this->assertTrue($level['on_hand_matches']);
        $this->assertTrue($level['reserved_matches']);

        // Debt is paid off.
        $this->assertSame('0.00', $account->fresh()->outstanding_balance);
    }

    public function test_business_buyer_cannot_settle_their_own_purchase_order(): void
    {
        [$buyer, $account] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $product->id, 'quantity' => 1],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '50.00']);
        $purchaseOrder = app(PurchaseOrderService::class)->createFromQuote($quote, $buyer);
        app(PurchaseOrderService::class)->approve($purchaseOrder, $this->inventoryManager());

        $this->actingAs($buyer)->post("/procurement/purchase-orders/{$purchaseOrder->id}/bank-transfer")
            ->assertForbidden();
    }
}
