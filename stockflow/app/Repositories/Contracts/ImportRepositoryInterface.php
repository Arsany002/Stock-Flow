<?php

namespace App\Repositories\Contracts;

use App\Models\ImportBatch;
use App\Models\ImportRow;
use Illuminate\Support\Collection;

interface ImportRepositoryInterface
{
    public function findBatch(string $id): ?ImportBatch;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createBatch(array $attributes): ImportBatch;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function updateBatch(ImportBatch $batch, array $attributes): ImportBatch;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function createRow(array $attributes): ImportRow;

    /**
     * @return Collection<int, ImportRow>
     */
    public function rowsForBatch(string $batchId): Collection;
}
