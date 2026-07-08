<?php

namespace Tests\Feature\Import;

use App\Enums\ImportEntity;
use App\Enums\ImportRowStatus;
use App\Enums\ImportStatus;
use App\Enums\MovementType;
use App\Enums\UserRole;
use App\Jobs\ImportCatalogJob;
use App\Models\Category;
use App\Models\ImportBatch;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\ImportService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;

class ImportWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_authorized_inventory_manager_can_upload_import(): void
    {
        Queue::fake();

        $manager = $this->inventoryManager();
        $file = $this->spreadsheetFile([
            ['sku', 'name', 'category_slug'],
            ['SKU-IMPORT-001', 'Imported product', 'widgets'],
        ]);

        $response = $this->actingAs($manager)->post('/imports', [
            'entity' => ImportEntity::Products->value,
            'file' => $file,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('import_batches', [
            'uploader_id' => $manager->id,
            'entity' => ImportEntity::Products->value,
            'status' => ImportStatus::Pending->value,
        ]);
        Queue::assertPushed(ImportCatalogJob::class);
    }

    public function test_unauthorized_user_gets_403_uploading_import(): void
    {
        Queue::fake();

        $customer = User::factory()->create();
        $customer->addRole(UserRole::RetailCustomer->value);

        $response = $this->actingAs($customer)->post('/imports', [
            'entity' => ImportEntity::Products->value,
            'file' => $this->spreadsheetFile([
                ['sku', 'name', 'category_slug'],
                ['SKU-BLOCKED', 'Blocked product', 'widgets'],
            ]),
        ]);

        $response->assertForbidden();
        $this->assertDatabaseCount('import_batches', 0);
    }

    public function test_valid_products_import_successfully(): void
    {
        $manager = $this->inventoryManager();
        Category::factory()->create(['slug' => 'widgets', 'name' => 'Widgets']);

        $this->startImport($manager, ImportEntity::Products, [
            ['sku', 'name', 'category_slug', 'description', 'is_active'],
            ['SKU-IMPORT-002', 'Imported widget', 'widgets', 'From Excel', 'yes'],
        ]);

        $this->assertDatabaseHas('products', [
            'sku' => 'SKU-IMPORT-002',
            'name' => 'Imported widget',
            'description' => 'From Excel',
            'is_active' => true,
        ]);

        $batch = ImportBatch::query()->latest()->first();
        $this->assertSame(ImportStatus::Completed, $batch->status);
        $this->assertSame(1, $batch->success_rows);
        $this->assertSame(0, $batch->failed_rows);
    }

    public function test_invalid_rows_are_reported_without_failing_whole_file(): void
    {
        $manager = $this->inventoryManager();
        Category::factory()->create(['slug' => 'widgets', 'name' => 'Widgets']);

        $this->startImport($manager, ImportEntity::Products, [
            ['sku', 'name', 'category_slug'],
            ['SKU-IMPORT-003', 'Valid widget', 'widgets'],
            [null, 'Missing SKU', 'widgets'],
        ]);

        $this->assertDatabaseHas('products', ['sku' => 'SKU-IMPORT-003']);
        $this->assertDatabaseHas('import_rows', ['status' => ImportRowStatus::Failed->value]);

        $batch = ImportBatch::query()->latest()->first();
        $this->assertSame(ImportStatus::Completed, $batch->status);
        $this->assertSame(2, $batch->total_rows);
        $this->assertSame(1, $batch->success_rows);
        $this->assertSame(1, $batch->failed_rows);
        $this->assertNotNull($batch->rows()->where('status', ImportRowStatus::Failed->value)->first()->error);
    }

    public function test_duplicate_sku_reimport_updates_existing_product(): void
    {
        $manager = $this->inventoryManager();
        Category::factory()->create(['slug' => 'widgets', 'name' => 'Widgets']);

        $this->startImport($manager, ImportEntity::Products, [
            ['sku', 'name', 'category_slug'],
            ['SKU-REIMPORT-001', 'Old name', 'widgets'],
        ]);

        $this->startImport($manager, ImportEntity::Products, [
            ['sku', 'name', 'category_slug'],
            ['SKU-REIMPORT-001', 'New name', 'widgets'],
        ]);

        $this->assertSame(1, Product::query()->where('sku', 'SKU-REIMPORT-001')->count());
        $this->assertSame('New name', Product::query()->where('sku', 'SKU-REIMPORT-001')->first()->name);
    }

    public function test_opening_stock_import_creates_stock_movements(): void
    {
        $manager = $this->inventoryManager();
        $product = Product::factory()->create(['sku' => 'SKU-STOCK-001']);
        $warehouse = Warehouse::factory()->create(['code' => 'MAIN']);

        $this->startImport($manager, ImportEntity::OpeningStock, [
            ['sku', 'warehouse_code', 'quantity'],
            ['SKU-STOCK-001', 'MAIN', 7],
        ]);

        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => MovementType::PurchaseIn->value,
            'quantity' => 7,
        ]);
    }

    public function test_opening_stock_import_updates_stock_levels(): void
    {
        $manager = $this->inventoryManager();
        $product = Product::factory()->create(['sku' => 'SKU-STOCK-002']);
        $warehouse = Warehouse::factory()->create(['code' => 'MAIN']);

        $this->startImport($manager, ImportEntity::OpeningStock, [
            ['sku', 'warehouse_code', 'quantity'],
            ['SKU-STOCK-002', 'MAIN', 9],
        ]);

        $level = StockLevel::query()
            ->where('product_id', $product->id)
            ->where('warehouse_id', $warehouse->id)
            ->first();

        $this->assertSame(9, $level->on_hand);
        $this->assertSame(0, $level->reserved);
        $this->assertSame(1, StockMovement::query()->where('product_id', $product->id)->count());

        $reconciliation = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertTrue($reconciliation['on_hand_matches']);
        $this->assertTrue($reconciliation['reserved_matches']);
    }

    public function test_import_progress_is_trackable(): void
    {
        $manager = $this->inventoryManager();
        Category::factory()->create(['slug' => 'widgets', 'name' => 'Widgets']);

        $this->startImport($manager, ImportEntity::Products, [
            ['sku', 'name', 'category_slug'],
            ['SKU-PROGRESS-001', 'Progress one', 'widgets'],
            [null, 'Progress failed', 'widgets'],
        ]);

        $batch = ImportBatch::query()->latest()->first();

        $this->actingAs($manager)
            ->get("/imports/{$batch->id}")
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Import/Show')
                ->where('batch.total_rows', 2)
                ->where('batch.success_rows', 1)
                ->where('batch.failed_rows', 1)
                ->has('rows.data', 2));
    }

    private function inventoryManager(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);

        return $user;
    }

    /**
     * @param  array<int, array<int, mixed>>  $rows
     */
    private function startImport(User $manager, ImportEntity $entity, array $rows): ImportBatch
    {
        app(ImportService::class)->start($manager, $entity, $this->spreadsheetFile($rows));

        return ImportBatch::query()->latest()->first();
    }

    /**
     * @param  array<int, array<int, mixed>>  $rows
     */
    private function spreadsheetFile(array $rows, string $filename = 'import.xlsx'): UploadedFile
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($rows as $rowIndex => $row) {
            foreach (array_values($row) as $columnIndex => $value) {
                $cell = Coordinate::stringFromColumnIndex($columnIndex + 1).($rowIndex + 1);
                $sheet->setCellValue($cell, $value);
            }
        }

        $path = tempnam(sys_get_temp_dir(), 'stockflow-import-');
        $xlsxPath = "{$path}.xlsx";

        unlink($path);
        (new Xlsx($spreadsheet))->save($xlsxPath);
        $spreadsheet->disconnectWorksheets();

        return new UploadedFile(
            $xlsxPath,
            $filename,
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true,
        );
    }
}
