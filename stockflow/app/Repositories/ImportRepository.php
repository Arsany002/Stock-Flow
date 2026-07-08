<?php

namespace App\Repositories;

use App\Enums\ImportRowStatus;
use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Repositories\Contracts\ImportRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ImportRepository implements ImportRepositoryInterface
{
    public function findBatch(string $id): ?ImportBatch
    {
        return ImportBatch::query()->with('uploader')->find($id);
    }

    public function paginateBatches(int $perPage = 15): LengthAwarePaginator
    {
        return ImportBatch::query()
            ->with('uploader')
            ->latest()
            ->paginate($perPage);
    }

    public function createBatch(array $attributes): ImportBatch
    {
        return ImportBatch::query()->create($attributes);
    }

    public function updateBatch(ImportBatch $batch, array $attributes): ImportBatch
    {
        $batch->update($attributes);

        return $batch;
    }

    public function createRow(array $attributes): ImportRow
    {
        return ImportRow::query()->create($attributes);
    }

    public function updateRow(ImportRow $row, array $attributes): ImportRow
    {
        $row->update($attributes);

        return $row;
    }

    public function rowsForBatch(string $batchId): Collection
    {
        return ImportRow::query()
            ->where('import_batch_id', $batchId)
            ->orderBy('row_number')
            ->get();
    }

    public function paginateRowsForBatch(string $batchId, int $perPage = 25): LengthAwarePaginator
    {
        return ImportRow::query()
            ->where('import_batch_id', $batchId)
            ->orderBy('row_number')
            ->paginate($perPage);
    }

    public function failedRowsForBatch(string $batchId): Collection
    {
        return ImportRow::query()
            ->where('import_batch_id', $batchId)
            ->where('status', ImportRowStatus::Failed)
            ->orderBy('row_number')
            ->get();
    }

    public function paginateForReport(int $perPage, array $filters = []): LengthAwarePaginator
    {
        return ImportBatch::query()
            ->with('uploader:id,name')
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->when($filters['entity'] ?? null, fn ($query, $entity) => $query->where('entity', $entity))
            ->when($filters['uploader_id'] ?? null, fn ($query, $id) => $query->where('uploader_id', $id))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }
}
