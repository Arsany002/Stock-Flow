<?php

namespace App\Services;

use App\Repositories\Contracts\ImportRepositoryInterface;

/**
 * Skeleton only — queued, batched Excel import with per-row validation and
 * upsert-by-natural-key (Epic 7) is implemented in the import module.
 */
class ImportService
{
    public function __construct(private readonly ImportRepositoryInterface $imports) {}

    public function run(string $importBatchId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function processRow(string $importBatchId, int $rowNumber, array $payload): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }
}
