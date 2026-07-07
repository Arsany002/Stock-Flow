<?php

namespace App\Repositories\Contracts;

use App\Models\BusinessAccount;

interface BusinessAccountRepositoryInterface
{
    public function find(string $id): ?BusinessAccount;

    public function findByUserId(int $userId): ?BusinessAccount;

    /**
     * Locks the row for update within the caller's transaction — used by
     * PurchaseOrderService before reading/mutating `outstanding_balance`,
     * so two concurrent PO approvals against the same account can't both
     * pass the credit check against the same stale balance. Callers must
     * wrap this in DB::transaction().
     */
    public function lockForUpdate(string $id): ?BusinessAccount;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(BusinessAccount $businessAccount, array $attributes): BusinessAccount;
}
