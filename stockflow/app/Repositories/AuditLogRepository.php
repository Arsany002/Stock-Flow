<?php

namespace App\Repositories;

use App\Models\ActivityLog;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AuditLogRepository implements AuditLogRepositoryInterface
{
    public function create(array $attributes): ActivityLog
    {
        return ActivityLog::query()->create($attributes);
    }

    public function paginate(int $perPage, array $filters = []): LengthAwarePaginator
    {
        return ActivityLog::query()
            ->with('causer:id,name')
            ->when($filters['event'] ?? null, fn ($query, $event) => $query->where('event', $event))
            ->when($filters['causer_id'] ?? null, fn ($query, $causerId) => $query->where('causer_id', $causerId))
            ->when($filters['subject_type'] ?? null, fn ($query, $type) => $query->where('subject_type', $type))
            ->when($filters['date_from'] ?? null, fn ($query, $date) => $query->where('created_at', '>=', $date))
            ->when($filters['date_to'] ?? null, fn ($query, $date) => $query->where('created_at', '<=', $date))
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function recent(int $limit = 5): Collection
    {
        return ActivityLog::query()
            ->with('causer:id,name')
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }
}
