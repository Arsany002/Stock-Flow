<?php

namespace Tests\Feature\Schema;

use App\Enums\ApprovalDecision;
use App\Enums\ImportEntity;
use App\Enums\ImportStatus;
use App\Enums\MovementType;
use App\Models\BusinessAccount;
use App\Models\Category;
use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PoApproval;
use App\Models\PoItem;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PDO;
use Tests\TestCase;

/**
 * Schema-level tests for the base StockFlow database, per
 * docs/project/canonical-decisions.md §5/§6 and the Enterprise PRD §6.
 *
 * These deliberately run against real MySQL (a dedicated `stockflow_testing`
 * database on the same server as dev, never the dev database itself) rather
 * than the suite's default SQLite `:memory:` connection: FULLTEXT indexes,
 * MySQL ENUM columns, and real FK/unique-constraint enforcement don't behave
 * identically on SQLite. This mirrors the PRD's own requirement that the
 * no-oversell concurrency test run against MySQL, not SQLite.
 */
class DatabaseSchemaTest extends TestCase
{
    private static bool $migrated = false;

    private string $originalDefaultConnection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->originalDefaultConnection = Config::get('database.default');

        $this->useDedicatedMysqlTestDatabase();

        if (! self::$migrated) {
            Artisan::call('migrate:fresh', ['--database' => 'mysql', '--force' => true]);
            self::$migrated = true;
        }
    }

    protected function tearDown(): void
    {
        // Restore the suite's default (SQLite in-memory) so switching to
        // MySQL here can never bleed into other test classes regardless of
        // run order.
        Config::set('database.default', $this->originalDefaultConnection);
        DB::purge('mysql');

        parent::tearDown();
    }

    private function useDedicatedMysqlTestDatabase(): void
    {
        $testDatabase = env('DB_TEST_DATABASE', 'stockflow_testing');
        $appUser = env('DB_USERNAME', 'stockflow');

        // The app's normal DB user only has grants on the dev database, so
        // bootstrap the dedicated test database (and its grant) as root.
        $root = new PDO(
            sprintf('mysql:host=%s;port=%s', env('DB_HOST', 'mysql'), env('DB_PORT', 3306)),
            'root',
            env('DB_ROOT_PASSWORD', 'stockflow_root')
        );
        $root->exec(
            "CREATE DATABASE IF NOT EXISTS `{$testDatabase}` ".
            'DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci'
        );
        $root->exec("GRANT ALL PRIVILEGES ON `{$testDatabase}`.* TO '{$appUser}'@'%'");
        $root->exec('FLUSH PRIVILEGES');

        Config::set('database.connections.mysql.database', $testDatabase);
        Config::set('database.default', 'mysql');
        DB::purge('mysql');
    }

    public function test_migrations_run_successfully(): void
    {
        $expectedTables = [
            'business_accounts', 'warehouses', 'suppliers', 'categories', 'products',
            'price_lists', 'price_list_items', 'stock_movements', 'stock_levels',
            'orders', 'order_items', 'quotes', 'quote_items', 'purchase_orders',
            'po_items', 'po_approvals', 'payments', 'import_batches', 'import_rows',
            'activity_log', 'users', 'roles', 'permissions',
        ];

        foreach ($expectedTables as $table) {
            $this->assertTrue(
                Schema::connection('mysql')->hasTable($table),
                "Expected table [{$table}] to exist."
            );
        }
    }

    public function test_products_sku_is_unique(): void
    {
        Product::factory()->create(['sku' => 'DUPLICATE-SKU']);

        $this->expectException(QueryException::class);

        Product::factory()->create(['sku' => 'DUPLICATE-SKU']);
    }

    public function test_stock_levels_has_unique_product_and_warehouse(): void
    {
        $level = StockLevel::factory()->create();

        $this->expectException(QueryException::class);

        StockLevel::factory()->create([
            'product_id' => $level->product_id,
            'warehouse_id' => $level->warehouse_id,
        ]);
    }

    public function test_payments_gateway_ref_is_unique(): void
    {
        Payment::factory()->create(['gateway_ref' => 'DUPLICATE-REF']);

        $this->expectException(QueryException::class);

        Payment::factory()->create(['gateway_ref' => 'DUPLICATE-REF']);
    }

    public function test_products_name_has_a_fulltext_index(): void
    {
        $indexes = DB::connection('mysql')->select(
            "SHOW INDEX FROM products WHERE Key_name = 'products_name_fulltext'"
        );

        $this->assertNotEmpty($indexes, 'Expected a FULLTEXT index on products.name.');
        $this->assertSame('FULLTEXT', $indexes[0]->Index_type);
    }

    public function test_available_stock_is_computed_not_stored(): void
    {
        $this->assertFalse(
            Schema::connection('mysql')->hasColumn('stock_levels', 'available'),
            'available must be computed (on_hand - reserved), never a stored column.'
        );

        $level = StockLevel::factory()->create(['on_hand' => 50, 'reserved' => 12]);

        $this->assertSame(38, $level->available);
    }

    public function test_products_table_has_no_quantity_column(): void
    {
        $this->assertFalse(Schema::connection('mysql')->hasColumn('products', 'quantity'));
    }

    public function test_catalog_relationships_resolve_correctly(): void
    {
        $parent = Category::factory()->create(['name' => 'Electronics', 'slug' => 'electronics-rel-test']);
        $child = Category::factory()->create(['parent_id' => $parent->id, 'name' => 'Phones', 'slug' => 'phones-rel-test']);
        $supplier = Supplier::factory()->create();
        $product = Product::factory()->create(['category_id' => $child->id, 'supplier_id' => $supplier->id]);

        $this->assertTrue($child->parent->is($parent));
        $this->assertTrue($parent->children->contains($child));
        $this->assertTrue($product->category->is($child));
        $this->assertTrue($product->supplier->is($supplier));
        $this->assertTrue($supplier->products->contains($product));
    }

    public function test_stock_ledger_and_projection_relationships_resolve_correctly(): void
    {
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();
        $actor = User::factory()->create();

        $movement = StockMovement::query()->create([
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => MovementType::PurchaseIn,
            'quantity' => 20,
            'actor_id' => $actor->id,
            'reason' => 'Test purchase-in',
        ]);

        $level = StockLevel::factory()->create([
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'on_hand' => 20,
            'reserved' => 0,
        ]);

        $this->assertTrue($movement->product->is($product));
        $this->assertTrue($movement->warehouse->is($warehouse));
        $this->assertTrue($movement->actor->is($actor));
        $this->assertTrue($level->product->is($product));
        $this->assertTrue($level->warehouse->is($warehouse));
        $this->assertTrue($product->stockMovements->contains($movement));
        $this->assertTrue($product->stockLevels->contains($level));
    }

    public function test_pricing_relationships_resolve_correctly(): void
    {
        $priceList = PriceList::factory()->create();
        $product = Product::factory()->create();

        $item = $priceList->items()->create([
            'product_id' => $product->id,
            'unit_price' => 99.99,
            'min_qty' => 1,
        ]);

        $this->assertTrue($priceList->items->contains($item));
        $this->assertTrue($item->priceList->is($priceList));
        $this->assertTrue($item->product->is($product));
        $this->assertTrue($product->priceListItems->contains($item));
    }

    public function test_b2c_order_relationships_resolve_correctly(): void
    {
        $order = Order::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $product = Product::factory()->create();

        $item = OrderItem::query()->create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 2,
            'unit_price' => 100,
            'line_total' => 200,
        ]);

        $payment = Payment::factory()->create([
            'payable_type' => Order::class,
            'payable_id' => $order->id,
        ]);

        $this->assertTrue($order->user->is($order->user));
        $this->assertTrue($order->items->contains($item));
        $this->assertTrue($item->order->is($order));
        $this->assertTrue($item->product->is($product));
        $this->assertTrue($item->warehouse->is($warehouse));
        $this->assertTrue($order->payments->contains($payment));
        $this->assertTrue($payment->payable->is($order));
    }

    public function test_b2b_quote_to_purchase_order_relationships_resolve_correctly(): void
    {
        $businessAccount = BusinessAccount::factory()->create();
        $quote = Quote::factory()->create(['business_account_id' => $businessAccount->id]);
        $product = Product::factory()->create();

        $quoteItem = QuoteItem::query()->create([
            'quote_id' => $quote->id,
            'product_id' => $product->id,
            'quantity' => 5,
            'unit_price' => 50,
        ]);

        $purchaseOrder = PurchaseOrder::factory()->create([
            'quote_id' => $quote->id,
            'business_account_id' => $businessAccount->id,
        ]);

        $warehouse = Warehouse::factory()->create();
        $poItem = PoItem::query()->create([
            'purchase_order_id' => $purchaseOrder->id,
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 5,
            'unit_price' => 50,
        ]);

        $approver = User::factory()->create();
        $approval = PoApproval::query()->create([
            'purchase_order_id' => $purchaseOrder->id,
            'approver_id' => $approver->id,
            'decision' => ApprovalDecision::Approved,
        ]);

        $payment = Payment::factory()->forPurchaseOrder($purchaseOrder)->create();

        $this->assertTrue($businessAccount->user->is($businessAccount->user));
        $this->assertTrue($businessAccount->quotes->contains($quote));
        $this->assertTrue($quote->businessAccount->is($businessAccount));
        $this->assertTrue($quote->items->contains($quoteItem));
        $this->assertTrue($purchaseOrder->quote->is($quote));
        $this->assertTrue($purchaseOrder->businessAccount->is($businessAccount));
        $this->assertTrue($purchaseOrder->items->contains($poItem));
        $this->assertTrue($purchaseOrder->approvals->contains($approval));
        $this->assertTrue($approval->approver->is($approver));
        $this->assertTrue($purchaseOrder->payments->contains($payment));
        $this->assertTrue($payment->payable->is($purchaseOrder));
    }

    public function test_import_relationships_resolve_correctly(): void
    {
        $uploader = User::factory()->create();
        $batch = ImportBatch::query()->create([
            'uploader_id' => $uploader->id,
            'entity' => ImportEntity::Products,
            'status' => ImportStatus::Pending,
        ]);

        $row = ImportRow::query()->create([
            'import_batch_id' => $batch->id,
            'row_number' => 1,
            'payload' => ['sku' => 'SKU-IMPORT-001'],
        ]);

        $this->assertTrue($batch->uploader->is($uploader));
        $this->assertTrue($batch->rows->contains($row));
        $this->assertTrue($row->importBatch->is($batch));
    }
}
