<?php

namespace Tests\Feature\Procurement;

use App\Enums\PurchaseOrderStatus;
use App\Enums\QuoteStatus;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Services\QuoteService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\SetsUpProcurementFixtures;
use Tests\TestCase;

/**
 * Scenarios 1–4 of the B2B procurement module.
 */
class QuoteWorkflowTest extends TestCase
{
    use RefreshDatabase, SetsUpProcurementFixtures;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_business_buyer_can_create_quote(): void
    {
        [$buyer] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();

        $response = $this->actingAs($buyer)->post('/procurement/quotes', [
            'lines' => [['product_id' => $product->id, 'quantity' => 5]],
        ]);

        $quote = Quote::query()->firstOrFail();
        $response->assertRedirect("/procurement/quotes/{$quote->id}");

        $this->assertSame(QuoteStatus::Draft, $quote->status);
        $this->assertCount(1, $quote->items);
        $this->assertSame(5, $quote->items->first()->quantity);
    }

    public function test_vendor_and_inventory_manager_can_price_quote(): void
    {
        [, $account] = $this->businessBuyer();
        [$vendorUser, $supplier] = $this->vendor();
        ['product' => $vendorProduct] = $this->productWithStock($supplier);
        ['product' => $otherProduct] = $this->productWithStock();

        $vendorQuote = app(QuoteService::class)->request($account, [
            ['product_id' => $vendorProduct->id, 'quantity' => 2],
        ]);

        $response = $this->actingAs($vendorUser)->post("/procurement/quotes/{$vendorQuote->id}/price", [
            'prices' => [$vendorQuote->items->first()->id => '150.00'],
        ]);
        $response->assertRedirect();

        $vendorQuote->refresh();
        $this->assertSame(QuoteStatus::Sent, $vendorQuote->status);
        $this->assertSame('150.00', $vendorQuote->items->first()->fresh()->unit_price);
        $this->assertSame('300.00', $vendorQuote->subtotal);
        $this->assertSame('42.00', $vendorQuote->tax);
        $this->assertSame('342.00', $vendorQuote->total);

        $manager = $this->inventoryManager();
        $managerQuote = app(QuoteService::class)->request($account, [
            ['product_id' => $otherProduct->id, 'quantity' => 1],
        ]);

        $this->actingAs($manager)->post("/procurement/quotes/{$managerQuote->id}/price", [
            'prices' => [$managerQuote->items->first()->id => '99.00'],
        ])->assertRedirect();

        $this->assertSame(QuoteStatus::Sent, $managerQuote->fresh()->status);
    }

    public function test_vendor_cannot_price_a_quote_outside_their_own_products(): void
    {
        [, $account] = $this->businessBuyer();
        [$vendorUser] = $this->vendor();
        ['product' => $otherVendorsProduct] = $this->productWithStock();

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $otherVendorsProduct->id, 'quantity' => 1],
        ]);

        $this->actingAs($vendorUser)->post("/procurement/quotes/{$quote->id}/price", [
            'prices' => [$quote->items->first()->id => '10.00'],
        ])->assertForbidden();
    }

    public function test_accepted_quote_creates_purchase_order_in_pending_approval(): void
    {
        [$buyer, $account] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $product->id, 'quantity' => 4],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '100.00']);

        $response = $this->actingAs($buyer)->post("/procurement/quotes/{$quote->id}/accept");

        $purchaseOrder = PurchaseOrder::query()->where('quote_id', $quote->id)->firstOrFail();
        $response->assertRedirect("/procurement/purchase-orders/{$purchaseOrder->id}");

        $this->assertSame(QuoteStatus::Accepted, $quote->fresh()->status);
        $this->assertSame(PurchaseOrderStatus::PendingApproval, $purchaseOrder->status);
        $this->assertCount(1, $purchaseOrder->items);
        $this->assertSame($quote->total, $purchaseOrder->total);
    }

    public function test_rejected_quote_cannot_create_purchase_order(): void
    {
        [$buyer, $account] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $product->id, 'quantity' => 1],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '10.00']);
        app(QuoteService::class)->reject($quote);

        $this->actingAs($buyer)->post("/procurement/quotes/{$quote->id}/accept")
            ->assertRedirect()
            ->assertSessionHas('flash.error');

        $this->assertSame(0, PurchaseOrder::query()->count());
    }

    public function test_expired_quote_cannot_create_purchase_order(): void
    {
        [$buyer, $account] = $this->businessBuyer();
        ['product' => $product] = $this->productWithStock();

        $quote = app(QuoteService::class)->request($account, [
            ['product_id' => $product->id, 'quantity' => 1],
        ]);
        $quote = app(QuoteService::class)->price($quote, [$quote->items->first()->id => '10.00']);
        $quote->forceFill(['expires_at' => now()->subDay()->toDateString()])->save();

        $this->actingAs($buyer)->post("/procurement/quotes/{$quote->id}/accept")
            ->assertRedirect()
            ->assertSessionHas('flash.error');

        $this->assertSame(0, PurchaseOrder::query()->count());
        $this->assertSame(QuoteStatus::Sent, $quote->fresh()->status);
    }
}
