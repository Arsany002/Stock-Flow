<?php

namespace App\Jobs;

use App\Services\ImportService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportCatalogJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly string $importBatchId) {}

    public function handle(ImportService $imports): void
    {
        $imports->run($this->importBatchId);
    }
}
