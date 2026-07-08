<?php

namespace App\Http\Controllers\Web\Reports;

use App\Enums\ImportEntity;
use App\Enums\ImportStatus;
use App\Enums\MovementType;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\User;
use App\Services\CatalogService;
use App\Services\ReportService;
use App\Services\StockService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Modules 5–9: five read-only reports, each paginated (requirement #4),
 * backed by an indexed repository query (requirement #5 — see the
 * migrations/queries ReportService delegates to), with the filter set
 * (date range, product, warehouse, status, user) applied wherever that
 * dimension actually exists on the underlying table — see each action's
 * comment for which subset applies and why.
 */
class ReportController extends Controller
{
    public function __construct(
        private readonly ReportService $reports,
        private readonly CatalogService $catalog,
        private readonly StockService $stock,
    ) {}

    public function lowStock(Request $request): Response
    {
        $filters = $this->filters($request, ['product_id', 'warehouse_id']);
        $threshold = $request->integer('threshold') ?: null;

        $levels = $this->reports->lowStock(20, $threshold, $filters)->through(fn (StockLevel $level) => [
            'id' => $level->id,
            'product' => $level->product?->only(['id', 'name', 'sku']),
            'warehouse' => $level->warehouse?->only(['id', 'name', 'code']),
            'on_hand' => $level->on_hand,
            'reserved' => $level->reserved,
            'available' => $level->available,
        ]);

        return Inertia::render('Reports/LowStock', [
            'levels' => $levels,
            'filters' => [...$filters, 'threshold' => $threshold],
            ...$this->catalogFilterOptions(),
        ]);
    }

    public function stockMovements(Request $request): Response
    {
        // date range, product, warehouse, status(->type), user(->actor)
        $filters = $this->filters($request, ['product_id', 'warehouse_id', 'date_from', 'date_to']);
        $filters['type'] = $request->string('type')->toString() ?: null;
        $filters['actor_id'] = $request->integer('actor_id') ?: null;

        $movements = $this->reports->stockMovements(20, $filters)->through(fn (StockMovement $movement) => [
            'id' => $movement->id,
            'product' => $movement->product?->only(['id', 'name', 'sku']),
            'warehouse' => $movement->warehouse?->only(['id', 'name', 'code']),
            'type' => $movement->type->value,
            'type_label' => $movement->type->label(),
            'quantity' => $movement->quantity,
            'actor' => $movement->actor?->only(['id', 'name']),
            'created_at' => $movement->created_at,
        ]);

        return Inertia::render('Reports/StockMovements', [
            'movements' => $movements,
            'filters' => $filters,
            'types' => collect(MovementType::cases())->map(fn ($t) => ['value' => $t->value, 'label' => $t->label()]),
            'users' => User::query()->orderBy('name')->get(['id', 'name']),
            ...$this->catalogFilterOptions(),
        ]);
    }

    public function sales(Request $request): Response
    {
        // date range, product, warehouse, status, user
        $filters = $this->filters($request, ['product_id', 'warehouse_id', 'date_from', 'date_to']);
        $filters['status'] = $request->string('status')->toString() ?: null;
        $filters['user_id'] = $request->integer('user_id') ?: null;

        $orders = $this->reports->sales(20, $filters)->through(fn ($order) => [
            'id' => $order->id,
            'status' => $order->status->value,
            'status_label' => $order->status->label(),
            'user' => $order->user?->only(['id', 'name']),
            'subtotal' => $order->subtotal,
            'tax' => $order->tax,
            'total' => $order->total,
            'created_at' => $order->created_at,
        ]);

        return Inertia::render('Reports/Sales', [
            'orders' => $orders,
            'filters' => $filters,
            'statuses' => collect(OrderStatus::cases())->map(fn ($s) => ['value' => $s->value, 'label' => $s->label()]),
            'users' => User::query()->orderBy('name')->get(['id', 'name']),
            ...$this->catalogFilterOptions(),
        ]);
    }

    public function payments(Request $request): Response
    {
        // date range, status, user — no product/warehouse dimension on payments.
        $filters = [
            'date_from' => $request->string('date_from')->toString() ?: null,
            'date_to' => $request->string('date_to')->toString() ?: null,
            'status' => $request->string('status')->toString() ?: null,
            'method' => $request->string('method')->toString() ?: null,
            'user_id' => $request->integer('user_id') ?: null,
        ];

        $payments = $this->reports->payments(20, $filters)->through(fn ($payment) => [
            'id' => $payment->id,
            'method' => $payment->method->value,
            'method_label' => $payment->method->label(),
            'status' => $payment->status->value,
            'status_label' => $payment->status->label(),
            'amount' => $payment->amount,
            'payable_type' => class_basename($payment->payable_type),
            'created_at' => $payment->created_at,
        ]);

        return Inertia::render('Reports/Payments', [
            'payments' => $payments,
            'filters' => $filters,
            'statuses' => collect(PaymentStatus::cases())->map(fn ($s) => ['value' => $s->value, 'label' => $s->label()]),
            'methods' => collect(PaymentMethod::cases())->map(fn ($m) => ['value' => $m->value, 'label' => $m->label()]),
            'users' => User::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function imports(Request $request): Response
    {
        // date range, status, user(->uploader) — entity stands in for "product".
        $filters = [
            'date_from' => $request->string('date_from')->toString() ?: null,
            'date_to' => $request->string('date_to')->toString() ?: null,
            'status' => $request->string('status')->toString() ?: null,
            'entity' => $request->string('entity')->toString() ?: null,
            'uploader_id' => $request->integer('uploader_id') ?: null,
        ];

        $batches = $this->reports->imports(20, $filters)->through(fn ($batch) => [
            'id' => $batch->id,
            'entity' => $batch->entity->value,
            'entity_label' => $batch->entity->label(),
            'status' => $batch->status->value,
            'status_label' => $batch->status->label(),
            'total_rows' => $batch->total_rows,
            'success_rows' => $batch->success_rows,
            'failed_rows' => $batch->failed_rows,
            'uploader' => $batch->uploader?->only(['id', 'name']),
            'created_at' => $batch->created_at,
        ]);

        return Inertia::render('Reports/Imports', [
            'batches' => $batches,
            'filters' => $filters,
            'statuses' => collect(ImportStatus::cases())->map(fn ($s) => ['value' => $s->value, 'label' => $s->label()]),
            'entities' => collect(ImportEntity::cases())->map(fn ($e) => ['value' => $e->value, 'label' => $e->label()]),
            'users' => User::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * @param  list<string>  $keys
     * @return array<string, mixed>
     */
    private function filters(Request $request, array $keys): array
    {
        $filters = [];

        foreach ($keys as $key) {
            $filters[$key] = $request->string($key)->toString() ?: null;
        }

        return $filters;
    }

    /**
     * @return array<string, mixed>
     */
    private function catalogFilterOptions(): array
    {
        return [
            'products' => collect($this->catalog->listProducts(1000)->items())->map->only(['id', 'name', 'sku']),
            'warehouses' => $this->stock->listActiveWarehouses()->map->only(['id', 'name', 'code']),
        ];
    }
}
