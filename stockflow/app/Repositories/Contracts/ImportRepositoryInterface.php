<?php

namespace App\Repositories\Contracts;

use App\Models\ImportBatch;
use App\Models\ImportRow;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ImportRepositoryInterface
{
    public function findBatch(string $id): ?ImportBatch;

    public function paginateBatches(int $perPage = 15): LengthAwarePaginator;

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
     * @param  array<string, mixed>  $attributes
     */
    public function updateRow(ImportRow $row, array $attributes): ImportRow;

    /**
     * @return Collection<int, ImportRow>
     */
    public function rowsForBatch(string $batchId): Collection;

    public function paginateRowsForBatch(string $batchId, int $perPage = 25): LengthAwarePaginator;

    public function failedRowsForBatch(string $batchId): Collection;

    /**
     * Paginated, filterable listing for the Import History report. No
     * product/warehouse filter — an import batch spans many rows/entities,
     * not a single product or warehouse; `entity` (the natural analog) is
     * exposed instead.
     *
     * @param  array<string, mixed>  $filters  status, entity, uploader_id (user), date_from, date_to
     */
    public function paginateForReport(int $perPage, array $filters = []): LengthAwarePaginator;
}
