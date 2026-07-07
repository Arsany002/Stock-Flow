<?php

namespace App\Repositories;

use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Repositories\Contracts\ImportRepositoryInterface;
use Illuminate\Support\Collection;

class ImportRepository implements ImportRepositoryInterface
{
    public function findBatch(string $id): ?ImportBatch
    {
        return ImportBatch::query()->find($id);
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

    public function rowsForBatch(string $batchId): Collection
    {
        return ImportRow::query()
            ->where('import_batch_id', $batchId)
            ->orderBy('row_number')
            ->get();
    }
}
