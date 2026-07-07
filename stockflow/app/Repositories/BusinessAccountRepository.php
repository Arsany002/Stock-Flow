<?php

namespace App\Repositories;

use App\Models\BusinessAccount;
use App\Repositories\Contracts\BusinessAccountRepositoryInterface;

class BusinessAccountRepository implements BusinessAccountRepositoryInterface
{
    public function find(string $id): ?BusinessAccount
    {
        return BusinessAccount::query()->find($id);
    }

    public function findByUserId(int $userId): ?BusinessAccount
    {
        return BusinessAccount::query()->where('user_id', $userId)->first();
    }

    public function lockForUpdate(string $id): ?BusinessAccount
    {
        return BusinessAccount::query()->lockForUpdate()->find($id);
    }

    public function update(BusinessAccount $businessAccount, array $attributes): BusinessAccount
    {
        $businessAccount->update($attributes);

        return $businessAccount;
    }
}
