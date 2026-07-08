<?php

namespace App\Repositories\Contracts;

use App\Enums\PurchaseOrderStatus;
use App\Models\PurchaseOrder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PurchaseOrderRepositoryInterface
{
    public function find(string $id): ?PurchaseOrder;

    public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Every PO — for staff (`po.approve`/`payment.settle` holders) who need
     * to see/act on any business account's orders, not just their own.
     */
    public function paginateAll(int $perPage = 15): LengthAwarePaginator;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): PurchaseOrder;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(PurchaseOrder $purchaseOrder, array $attributes): PurchaseOrder;

    /**
     * Cheap COUNT for dashboard KPIs — e.g. "pending approvals" for staff,
     * optionally scoped to one business account.
     */
    public function countByStatus(PurchaseOrderStatus $status, ?string $businessAccountId = null): int;
}
