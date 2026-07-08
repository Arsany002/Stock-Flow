<?php

namespace App\Services;

use App\Enums\ImportEntity;
use App\Enums\ImportRowStatus;
use App\Enums\ImportStatus;
use App\Enums\PriceListType;
use App\Exceptions\ImportValidationException;
use App\Imports\CatalogRowsImport;
use App\Jobs\ImportCatalogJob;
use App\Models\Category;
use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use App\Repositories\Contracts\ImportRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use RuntimeException;
use Throwable;

class ImportService
{
    private const ROW_BATCH_SIZE = 100;

    public function __construct(
        private readonly ImportRepositoryInterface $imports,
        private readonly StockService $stock,
    ) {}

    public function listBatches(int $perPage = 15): LengthAwarePaginator
    {
        return $this->imports->paginateBatches($perPage);
    }

    public function findBatch(string $id): ?ImportBatch
    {
        return $this->imports->findBatch($id);
    }

    public function rowsForBatch(string $batchId, int $perPage = 25): LengthAwarePaginator
    {
        return $this->imports->paginateRowsForBatch($batchId, $perPage);
    }

    /**
     * @return Collection<int, ImportRow>
     */
    public function failedRowsForBatch(string $batchId): Collection
    {
        return $this->imports->failedRowsForBatch($batchId);
    }

    public function start(User $uploader, ImportEntity $entity, UploadedFile $file): ImportBatch
    {
        $batch = $this->imports->createBatch([
            'uploader_id' => $uploader->id,
            'entity' => $entity,
            'file_path' => $file->store('imports'),
            'original_filename' => $file->getClientOriginalName(),
            'status' => ImportStatus::Pending,
            'total_rows' => 0,
            'success_rows' => 0,
            'failed_rows' => 0,
        ]);

        ImportCatalogJob::dispatch($batch->id);

        return $batch;
    }

    public function run(string $importBatchId): void
    {
        $batch = $this->imports->findBatch($importBatchId);

        if (! $batch) {
            throw new RuntimeException("Import batch {$importBatchId} was not found.");
        }

        try {
            $this->imports->updateBatch($batch, ['status' => ImportStatus::Processing]);

            if ($this->imports->rowsForBatch($batch->id)->isEmpty()) {
                $this->createRowsFromFile($batch);
            }

            $this->processPendingRows($batch);
            $this->refreshBatchCounts($batch, ImportStatus::Completed);
            $this->flushCatalogCache($batch->entity);
        } catch (Throwable $exception) {
            $this->imports->updateBatch($batch->fresh(), ['status' => ImportStatus::Failed]);

            throw $exception;
        }
    }

    public function processRow(string $importBatchId, int $rowNumber, array $payload): void
    {
        $batch = $this->imports->findBatch($importBatchId);

        if (! $batch) {
            throw new RuntimeException("Import batch {$importBatchId} was not found.");
        }

        $row = $this->imports->createRow([
            'import_batch_id' => $batch->id,
            'row_number' => $rowNumber,
            'payload' => $this->normalizePayload($payload),
            'status' => ImportRowStatus::Pending,
        ]);

        DB::transaction(function () use ($batch, $row) {
            try {
                DB::transaction(fn () => $this->importStoredRow($batch, $row));
            } catch (Throwable $exception) {
                $this->recordFailedRow($row->fresh(), $exception);
            }
        });

        $this->refreshBatchCounts($batch);
        $this->flushCatalogCache($batch->entity);
    }

    private function createRowsFromFile(ImportBatch $batch): void
    {
        if (! $batch->file_path) {
            throw new RuntimeException("Import batch {$batch->id} does not have an uploaded file.");
        }

        $import = new CatalogRowsImport;

        Excel::import($import, $batch->file_path, 'local');

        $rows = $import->rows()
            ->map(fn (array $payload, int $index) => [
                'id' => (string) Str::uuid(),
                'import_batch_id' => $batch->id,
                'row_number' => $index + 2,
                'payload' => json_encode($this->normalizePayload($payload), JSON_THROW_ON_ERROR),
                'status' => ImportRowStatus::Pending->value,
            ])
            ->values();

        DB::transaction(function () use ($batch, $rows) {
            $rows->chunk(self::ROW_BATCH_SIZE)->each(function (Collection $chunk) {
                ImportRow::query()->insert($chunk->all());
            });

            $this->imports->updateBatch($batch, [
                'total_rows' => $rows->count(),
                'success_rows' => 0,
                'failed_rows' => 0,
            ]);
        });
    }

    private function processPendingRows(ImportBatch $batch): void
    {
        $pendingRows = $this->imports->rowsForBatch($batch->id)
            ->filter(fn (ImportRow $row) => $row->status === ImportRowStatus::Pending)
            ->values();

        $pendingRows->chunk(self::ROW_BATCH_SIZE)->each(function (Collection $chunk) use ($batch) {
            DB::transaction(function () use ($batch, $chunk) {
                $chunk->each(function (ImportRow $row) use ($batch) {
                    try {
                        DB::transaction(fn () => $this->importStoredRow($batch, $row));
                    } catch (Throwable $exception) {
                        $this->recordFailedRow($row->fresh(), $exception);
                    }
                });
            });

            $this->refreshBatchCounts($batch, ImportStatus::Processing);
        });
    }

    private function importStoredRow(ImportBatch $batch, ImportRow $row): void
    {
        match ($batch->entity) {
            ImportEntity::Categories => $this->importCategory($row),
            ImportEntity::Products => $this->importProduct($row),
            ImportEntity::Warehouses => $this->importWarehouse($row),
            ImportEntity::Suppliers => $this->importSupplier($row),
            ImportEntity::PriceLists => $this->importPriceListItem($row),
            ImportEntity::OpeningStock => $this->importOpeningStock($batch, $row),
        };

        $this->imports->updateRow($row, [
            'status' => ImportRowStatus::Imported,
            'error' => null,
        ]);
    }

    private function importCategory(ImportRow $row): void
    {
        $data = $this->validate($row, [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'parent_slug' => ['nullable', 'string', 'max:255'],
        ]);

        $slug = $data['slug'] ?: Str::slug($data['name']);

        if ($slug === '') {
            $this->failRow($row, 'slug', 'A slug is required when the name cannot be converted to one.');
        }

        $parentId = null;

        if ($data['parent_slug']) {
            if ($data['parent_slug'] === $slug) {
                $this->failRow($row, 'parent_slug', 'A category cannot be its own parent.');
            }

            $parent = Category::query()->where('slug', $data['parent_slug'])->first();

            if (! $parent) {
                $this->failRow($row, 'parent_slug', "Parent category [{$data['parent_slug']}] was not found.");
            }

            $parentId = $parent->id;
        }

        Category::query()->updateOrCreate(
            ['slug' => $slug],
            ['name' => $data['name'], 'parent_id' => $parentId],
        );
    }

    private function importProduct(ImportRow $row): void
    {
        $data = $this->validate($row, [
            'sku' => ['required', 'string', 'max:64'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_slug' => ['nullable', 'string', 'max:255'],
            'category_name' => ['nullable', 'string', 'max:255'],
            'supplier_email' => ['nullable', 'email', 'max:255'],
            'supplier_name' => ['nullable', 'string', 'max:255'],
            'supplier_phone' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable'],
        ]);

        $category = $this->resolveCategory($row, $data['category_slug'], $data['category_name']);
        $supplier = $this->resolveSupplier($row, $data['supplier_name'], $data['supplier_email'], $data['supplier_phone']);

        Product::query()->updateOrCreate(
            ['sku' => $data['sku']],
            [
                'category_id' => $category->id,
                'supplier_id' => $supplier?->id,
                'name' => $data['name'],
                'description' => $data['description'],
                'is_active' => $this->booleanValue($row, 'is_active', $data['is_active'], true),
            ],
        );
    }

    private function importWarehouse(ImportRow $row): void
    {
        $data = $this->validate($row, [
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable'],
        ]);

        Warehouse::query()->updateOrCreate(
            ['code' => $data['code']],
            [
                'name' => $data['name'],
                'address' => $data['address'],
                'is_active' => $this->booleanValue($row, 'is_active', $data['is_active'], true),
            ],
        );
    }

    private function importSupplier(ImportRow $row): void
    {
        $data = $this->validate($row, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable'],
        ]);

        $lookup = $data['email']
            ? ['email' => $data['email']]
            : ['name' => $data['name']];

        Supplier::query()->updateOrCreate($lookup, [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'is_active' => $this->booleanValue($row, 'is_active', $data['is_active'], true),
        ]);
    }

    private function importPriceListItem(ImportRow $row): void
    {
        $data = $this->validate($row, [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(array_column(PriceListType::cases(), 'value'))],
            'sku' => ['required', 'string', 'max:64'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'min_qty' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['nullable'],
        ]);

        $product = Product::query()->where('sku', $data['sku'])->first();

        if (! $product) {
            $this->failRow($row, 'sku', "Product SKU [{$data['sku']}] was not found.");
        }

        $priceList = PriceList::query()->updateOrCreate(
            ['name' => $data['name'], 'type' => $data['type']],
            ['is_active' => $this->booleanValue($row, 'is_active', $data['is_active'], true)],
        );

        PriceListItem::query()->updateOrCreate(
            [
                'price_list_id' => $priceList->id,
                'product_id' => $product->id,
                'min_qty' => $data['min_qty'] ?: 1,
            ],
            ['unit_price' => $data['unit_price']],
        );
    }

    private function importOpeningStock(ImportBatch $batch, ImportRow $row): void
    {
        $data = $this->validate($row, [
            'sku' => ['required', 'string', 'max:64'],
            'warehouse_code' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:0'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $product = Product::query()->where('sku', $data['sku'])->first();

        if (! $product) {
            $this->failRow($row, 'sku', "Product SKU [{$data['sku']}] was not found.");
        }

        $warehouse = Warehouse::query()->where('code', $data['warehouse_code'])->first();

        if (! $warehouse) {
            $this->failRow($row, 'warehouse_code', "Warehouse [{$data['warehouse_code']}] was not found.");
        }

        $level = StockLevel::query()
            ->where('product_id', $product->id)
            ->where('warehouse_id', $warehouse->id)
            ->first();

        $currentOnHand = $level?->on_hand ?? 0;
        $reserved = $level?->reserved ?? 0;
        $targetOnHand = (int) $data['quantity'];

        if ($targetOnHand < $reserved) {
            $this->failRow($row, 'quantity', "Opening stock cannot be below the reserved quantity ({$reserved}).");
        }

        $delta = $targetOnHand - $currentOnHand;

        if ($delta > 0 && $currentOnHand === 0) {
            $this->stock->purchaseIn(
                $product,
                $warehouse,
                $targetOnHand,
                $batch->uploader,
                $row,
                $data['reason'] ?: "Opening stock import row {$row->row_number}",
            );
        } elseif ($delta !== 0) {
            $this->stock->adjust(
                $product,
                $warehouse,
                $delta,
                $batch->uploader,
                $data['reason'] ?: "Opening stock import row {$row->row_number}",
            );
        }

        $mismatches = $this->stock->reconcile($product, $warehouse)
            ->reject(fn (array $result) => $result['on_hand_matches'] && $result['reserved_matches']);

        if ($mismatches->isNotEmpty()) {
            $this->failRow($row, 'quantity', 'Opening stock did not reconcile against the movement ledger.');
        }
    }

    /**
     * @param  array<string, mixed>  $rules
     * @return array<string, mixed>
     */
    private function validate(ImportRow $row, array $rules): array
    {
        $validator = Validator::make($row->payload, $rules);

        if ($validator->fails()) {
            throw ImportValidationException::forRow($row->row_number, $validator->errors()->toArray());
        }

        return collect(array_keys($rules))
            ->mapWithKeys(fn (string $key) => [$key => $validator->validated()[$key] ?? null])
            ->all();
    }

    private function resolveCategory(ImportRow $row, ?string $slug, ?string $name): Category
    {
        if ($slug) {
            $category = Category::query()->where('slug', $slug)->first();

            if ($category) {
                return $category;
            }

            if (! $name) {
                $this->failRow($row, 'category_slug', "Category [{$slug}] was not found.");
            }

            return Category::query()->create(['slug' => $slug, 'name' => $name]);
        }

        if (! $name) {
            $this->failRow($row, 'category_slug', 'Either category_slug or category_name is required.');
        }

        return Category::query()->firstOrCreate(
            ['slug' => Str::slug($name)],
            ['name' => $name],
        );
    }

    private function resolveSupplier(ImportRow $row, ?string $name, ?string $email, ?string $phone): ?Supplier
    {
        if (! $name && ! $email && ! $phone) {
            return null;
        }

        $supplier = $email
            ? Supplier::query()->where('email', $email)->first()
            : Supplier::query()->where('name', $name)->first();

        if (! $supplier && ! $name) {
            $this->failRow($row, 'supplier_name', 'supplier_name is required when creating a new supplier.');
        }

        $supplier ??= new Supplier;
        $supplier->fill([
            'name' => $name ?: $supplier->name,
            'email' => $email ?: $supplier->email,
            'phone' => $phone ?: $supplier->phone,
            'is_active' => true,
        ]);
        $supplier->save();

        return $supplier;
    }

    private function booleanValue(ImportRow $row, string $field, mixed $value, bool $default): bool
    {
        if ($value === null || $value === '') {
            return $default;
        }

        if (is_bool($value)) {
            return $value;
        }

        $normalized = strtolower(trim((string) $value));

        return match ($normalized) {
            '1', 'true', 'yes', 'y', 'active' => true,
            '0', 'false', 'no', 'n', 'inactive' => false,
            default => $this->failRow($row, $field, 'Expected a boolean value.'),
        };
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    private function normalizePayload(array $payload): array
    {
        $normalized = [];

        foreach ($payload as $key => $value) {
            $normalizedKey = preg_replace('/[^a-z0-9_]/', '', str_replace([' ', '-'], '_', strtolower(trim((string) $key)))) ?? '';

            if ($normalizedKey === '') {
                continue;
            }

            $normalized[$normalizedKey] = is_string($value) ? trim($value) : $value;

            if ($normalized[$normalizedKey] === '') {
                $normalized[$normalizedKey] = null;
            }
        }

        return $normalized;
    }

    private function recordFailedRow(ImportRow $row, Throwable $exception): void
    {
        $this->imports->updateRow($row, [
            'status' => ImportRowStatus::Failed,
            'error' => $this->formatRowError($exception),
        ]);
    }

    private function refreshBatchCounts(ImportBatch $batch, ?ImportStatus $status = null): ImportBatch
    {
        $query = ImportRow::query()->where('import_batch_id', $batch->id);

        $attributes = [
            'total_rows' => (clone $query)->count(),
            'success_rows' => (clone $query)->where('status', ImportRowStatus::Imported)->count(),
            'failed_rows' => (clone $query)->where('status', ImportRowStatus::Failed)->count(),
        ];

        if ($status) {
            $attributes['status'] = $status;
        }

        return $this->imports->updateBatch($batch->fresh(), $attributes);
    }

    private function formatRowError(Throwable $exception): string
    {
        if ($exception instanceof ImportValidationException) {
            $message = collect($exception->errors())
                ->map(fn (array $messages, string $field) => "{$field}: ".implode(', ', $messages))
                ->implode('; ');
        } else {
            $message = $exception->getMessage();
        }

        return Str::limit($message ?: 'Import row failed.', 250, '');
    }

    private function failRow(ImportRow $row, string $field, string $message): never
    {
        throw ImportValidationException::forRow($row->row_number, [$field => [$message]]);
    }

    private function flushCatalogCache(ImportEntity $entity): void
    {
        if ($entity === ImportEntity::OpeningStock) {
            return;
        }

        try {
            Cache::tags(['catalog'])->flush();
        } catch (Throwable) {
            Cache::flush();
        }
    }
}
