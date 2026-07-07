<?php

namespace Tests\Unit\Services;

use App\Enums\MovementType;
use App\Exceptions\InvalidStateTransitionException;
use App\Exceptions\OutOfStockException;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Unit-level proof of the stock engine's 12 invariants from
 * docs/project/canonical-decisions.md §6. Runs against the suite's default
 * SQLite connection — no real concurrency is exercised here (see
 * tests/Feature/Stock/StockConcurrencyTest.php for that), just correctness
 * of each operation in isolation.
 */
class StockServiceTest extends TestCase
{
    use RefreshDatabase;

    private StockService $stock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->stock = app(StockService::class);
    }

    public function test_purchase_in_increases_on_hand(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $actor = User::factory()->create();

        $level = $this->stock->purchaseIn($product, $warehouse, 50, $actor, null);

        $this->assertSame(50, $level->on_hand);
        $this->assertSame(0, $level->reserved);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => MovementType::PurchaseIn->value,
            'quantity' => 50,
            'actor_id' => $actor->id,
        ]);
    }

    public function test_reserve_increases_reserved_and_keeps_on_hand(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 100, null, null);

        $level = $this->stock->reserve($product, $warehouse, 30, null, null);

        $this->assertSame(100, $level->on_hand);
        $this->assertSame(30, $level->reserved);
        $this->assertSame(70, $level->available);
    }

    public function test_reserve_fails_if_available_is_less_than_requested_quantity(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 10, null, null);
        $this->stock->reserve($product, $warehouse, 10, null, null);

        $this->expectException(OutOfStockException::class);

        $this->stock->reserve($product, $warehouse, 1, null, null);
    }

    public function test_reserve_does_not_write_a_movement_or_mutate_level_when_it_fails(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 5, null, null);

        try {
            $this->stock->reserve($product, $warehouse, 999, null, null);
            $this->fail('Expected OutOfStockException.');
        } catch (OutOfStockException) {
            // expected
        }

        $this->assertSame(0, StockMovement::query()->where('type', MovementType::Reservation->value)->count());
        $this->assertSame(5, $this->stock->reconcile($product, $warehouse)->first()['on_hand']);
    }

    public function test_release_decreases_reserved(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 100, null, null);
        $this->stock->reserve($product, $warehouse, 40, null, null);

        $level = $this->stock->release($product, $warehouse, 15, null, null);

        $this->assertSame(100, $level->on_hand);
        $this->assertSame(25, $level->reserved);
    }

    public function test_release_fails_when_releasing_more_than_reserved(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 10, null, null);
        $this->stock->reserve($product, $warehouse, 5, null, null);

        $this->expectException(InvalidStateTransitionException::class);

        $this->stock->release($product, $warehouse, 6, null, null);
    }

    public function test_confirm_sale_decreases_reserved_and_on_hand(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 100, null, null);
        $this->stock->reserve($product, $warehouse, 20, null, null);

        $level = $this->stock->confirmSale($product, $warehouse, 20, null, null);

        $this->assertSame(80, $level->on_hand);
        $this->assertSame(0, $level->reserved);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => MovementType::SaleOut->value,
            'quantity' => -20,
        ]);
    }

    public function test_confirm_sale_fails_when_confirming_more_than_reserved(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 10, null, null);
        $this->stock->reserve($product, $warehouse, 3, null, null);

        $this->expectException(InvalidStateTransitionException::class);

        $this->stock->confirmSale($product, $warehouse, 4, null, null);
    }

    public function test_transfer_creates_paired_transfer_out_and_transfer_in(): void
    {
        $product = Product::factory()->create();
        $from = Warehouse::factory()->create();
        $to = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $from, 60, null, null);

        $result = $this->stock->transfer($product, $from, $to, 25, null, null);

        $this->assertSame(35, $result['from']->on_hand);
        $this->assertSame(25, $result['to']->on_hand);

        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $from->id,
            'type' => MovementType::TransferOut->value,
            'quantity' => -25,
        ]);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $to->id,
            'type' => MovementType::TransferIn->value,
            'quantity' => 25,
        ]);
    }

    public function test_transfer_is_atomic_no_partial_movements_when_it_fails(): void
    {
        $product = Product::factory()->create();
        $from = Warehouse::factory()->create();
        $to = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $from, 10, null, null);

        try {
            $this->stock->transfer($product, $from, $to, 999, null, null);
            $this->fail('Expected OutOfStockException.');
        } catch (OutOfStockException) {
            // expected
        }

        $this->assertSame(0, StockMovement::query()->whereIn('type', [
            MovementType::TransferOut->value,
            MovementType::TransferIn->value,
        ])->count());

        $reconciled = $this->stock->reconcile($product)->keyBy('warehouse_id');
        $this->assertSame(10, $reconciled[$from->id]['on_hand']);
        $this->assertArrayNotHasKey($to->id, $reconciled->toArray());
    }

    public function test_adjustment_records_reason_and_actor(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $actor = User::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 20, null, null);

        $level = $this->stock->adjust($product, $warehouse, -5, $actor, 'Cycle count correction');

        $this->assertSame(15, $level->on_hand);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => MovementType::Adjustment->value,
            'quantity' => -5,
            'reason' => 'Cycle count correction',
            'actor_id' => $actor->id,
        ]);
    }

    public function test_adjustment_cannot_take_on_hand_negative(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 5, null, null);

        $this->expectException(OutOfStockException::class);

        $this->stock->adjust($product, $warehouse, -6, null, 'Damaged stock');
    }

    public function test_reconciliation_proves_ledger_equals_stock_levels(): void
    {
        $product = Product::factory()->create();
        $warehouseA = Warehouse::factory()->create();
        $warehouseB = Warehouse::factory()->create();

        $this->stock->purchaseIn($product, $warehouseA, 100, null, null);
        $this->stock->reserve($product, $warehouseA, 30, null, null);
        $this->stock->confirmSale($product, $warehouseA, 10, null, null);
        $this->stock->transfer($product, $warehouseA, $warehouseB, 20, null, null);
        $this->stock->adjust($product, $warehouseB, -2, null, 'Damage');

        $results = $this->stock->reconcile($product);

        $this->assertCount(2, $results);
        foreach ($results as $row) {
            $this->assertTrue($row['on_hand_matches'], "on_hand mismatch for warehouse {$row['warehouse_id']}");
            $this->assertTrue($row['reserved_matches'], "reserved mismatch for warehouse {$row['warehouse_id']}");
        }
    }

    public function test_reconciliation_detects_a_drifted_projection(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $this->stock->purchaseIn($product, $warehouse, 40, null, null);

        // Simulate ledger/projection drift directly (bypassing the service,
        // which is exactly what reconcile() exists to catch).
        $product->stockLevels()->where('warehouse_id', $warehouse->id)->update(['on_hand' => 999]);

        $row = $this->stock->reconcile($product, $warehouse)->first();

        $this->assertFalse($row['on_hand_matches']);
        $this->assertSame(999, $row['on_hand']);
        $this->assertSame(40, $row['ledger_on_hand']);
    }
}
