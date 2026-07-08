<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * The only place `activity_log` is ever written — mirrors StockService
 * being the only writer of `stock_movements`. Called from inside the
 * business-rule Services that perform an auditable action (stock
 * adjustments, PO approvals, payment settlement, role/permission changes),
 * never from a Controller directly, so an audit entry can never be
 * recorded without the action it describes actually having happened (both
 * live inside the same DB::transaction() in the caller).
 *
 * See docs/project/canonical-decisions.md §2 and requirement #2 of the
 * admin/audit/dashboard/reports module for the exact event categories.
 */
class AuditService
{
    public function __construct(private readonly AuditLogRepositoryInterface $logs) {}

    /**
     * @param  array<string, mixed>  $properties
     */
    public function record(string $event, ?Model $subject, ?User $causer, array $properties = []): ActivityLog
    {
        return $this->logs->create([
            'causer_id' => $causer?->id,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'event' => $event,
            'properties' => $properties,
        ]);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function listAll(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->logs->paginate($perPage, $filters);
    }
}
