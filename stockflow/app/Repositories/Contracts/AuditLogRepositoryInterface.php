<?php

namespace App\Repositories\Contracts;

use App\Models\ActivityLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AuditLogRepositoryInterface
{
    /**
     * Appends an audit entry. `activity_log` is write-once from the
     * application's perspective — nothing ever updates or deletes a row.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): ActivityLog;

    /**
     * Paginated, filterable listing for the Admin/AuditLog/Index page.
     *
     * @param  array<string, mixed>  $filters  event, causer_id, subject_type, date_from, date_to
     */
    public function paginate(int $perPage, array $filters = []): LengthAwarePaginator;

    /**
     * The most recent $limit entries — the dashboard's "recent activity"
     * KPI. Deliberately unfiltered/unpaginated: it's a small, fixed-size
     * peek, not a report.
     *
     * @return Collection<int, ActivityLog>
     */
    public function recent(int $limit = 5): Collection;
}
