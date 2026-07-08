<?php

namespace App\Repositories;

use App\Enums\PurchaseOrderStatus;
use App\Models\PurchaseOrder;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PurchaseOrderRepository implements PurchaseOrderRepositoryInterface
{
    public function find(string $id): ?PurchaseOrder
    {
        return PurchaseOrder::query()->find($id);
    }

    public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator
    {
        return PurchaseOrder::query()
            ->where('business_account_id', $businessAccountId)
            ->latest()
            ->paginate($perPage);
    }

    public function paginateAll(int $perPage = 15): LengthAwarePaginator
    {
        return PurchaseOrder::query()->latest()->paginate($perPage);
    }

    public function create(array $attributes): PurchaseOrder
    {
        return PurchaseOrder::query()->create($attributes);
    }

    public function update(PurchaseOrder $purchaseOrder, array $attributes): PurchaseOrder
    {
        $purchaseOrder->update($attributes);

        return $purchaseOrder;
    }

    public function countByStatus(PurchaseOrderStatus $status, ?string $businessAccountId = null): int
    {
        return PurchaseOrder::query()
            ->where('status', $status)
            ->when($businessAccountId, fn ($query, $id) => $query->where('business_account_id', $id))
            ->count();
    }
}
