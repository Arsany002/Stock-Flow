<?php

namespace App\Http\Controllers\Web\Import;

use App\Enums\ImportEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Import\StoreImportRequest;
use App\Models\ImportBatch;
use App\Models\ImportRow;
use App\Services\ImportService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImportController extends Controller
{
    public function __construct(private readonly ImportService $imports) {}

    public function index(): Response
    {
        return Inertia::render('Import/Index', [
            'batches' => $this->imports->listBatches()->through(fn (ImportBatch $batch) => $this->batchPayload($batch)),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Import/Create', [
            'entities' => collect(ImportEntity::cases())->map(fn (ImportEntity $entity) => [
                'value' => $entity->value,
                'label' => $entity->label(),
            ])->values(),
        ]);
    }

    public function store(StoreImportRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $batch = $this->imports->start(
            $request->user(),
            ImportEntity::from($validated['entity']),
            $request->file('file'),
        );

        return redirect()
            ->route('imports.show', $batch)
            ->with('flash.success', 'Import queued.');
    }

    public function show(ImportBatch $importBatch): Response
    {
        $batch = $this->imports->findBatch($importBatch->id) ?? $importBatch;

        return Inertia::render('Import/Show', [
            'batch' => $this->batchPayload($batch),
            'rows' => $this->imports->rowsForBatch($batch->id)->through(fn (ImportRow $row) => $this->rowPayload($row)),
        ]);
    }

    public function errorReport(ImportBatch $importBatch): Response
    {
        $batch = $this->imports->findBatch($importBatch->id) ?? $importBatch;

        return Inertia::render('Import/ErrorReport', [
            'batch' => $this->batchPayload($batch),
            'rows' => $this->imports->failedRowsForBatch($batch->id)->map(fn (ImportRow $row) => $this->rowPayload($row)),
        ]);
    }

    public function downloadErrorReport(ImportBatch $importBatch): StreamedResponse
    {
        $rows = $this->imports->failedRowsForBatch($importBatch->id);
        $filename = "import-{$importBatch->id}-errors.csv";

        return response()->streamDownload(function () use ($rows) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['row_number', 'status', 'error', 'payload']);

            $rows->each(function (ImportRow $row) use ($handle) {
                fputcsv($handle, [
                    $row->row_number,
                    $row->status->value,
                    $row->error,
                    json_encode($row->payload, JSON_UNESCAPED_SLASHES),
                ]);
            });

            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    /**
     * @return array<string, mixed>
     */
    private function batchPayload(ImportBatch $batch): array
    {
        return [
            'id' => $batch->id,
            'entity' => $batch->entity->value,
            'entity_label' => $batch->entity->label(),
            'status' => $batch->status->value,
            'status_label' => $batch->status->label(),
            'total_rows' => $batch->total_rows,
            'success_rows' => $batch->success_rows,
            'failed_rows' => $batch->failed_rows,
            'original_filename' => $batch->original_filename,
            'uploader' => $batch->uploader?->only(['id', 'name']),
            'created_at' => $batch->created_at?->toDateTimeString(),
            'updated_at' => $batch->updated_at?->toDateTimeString(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function rowPayload(ImportRow $row): array
    {
        return [
            'id' => $row->id,
            'row_number' => $row->row_number,
            'payload' => $row->payload,
            'status' => $row->status->value,
            'status_label' => $row->status->label(),
            'error' => $row->error,
        ];
    }
}
