<?php

namespace App\Repositories;

use App\Models\Quote;
use App\Repositories\Contracts\QuoteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class QuoteRepository implements QuoteRepositoryInterface
{
    public function find(string $id): ?Quote
    {
        return Quote::query()->find($id);
    }

    public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator
    {
        return Quote::query()
            ->where('business_account_id', $businessAccountId)
            ->latest()
            ->paginate($perPage);
    }

    public function paginateForVendor(int $vendorUserId, int $perPage = 15): LengthAwarePaginator
    {
        return Quote::query()
            ->whereHas('items.product.supplier', fn ($query) => $query->where('user_id', $vendorUserId))
            ->latest()
            ->paginate($perPage);
    }

    public function paginateAll(int $perPage = 15): LengthAwarePaginator
    {
        return Quote::query()->latest()->paginate($perPage);
    }

    public function create(array $attributes): Quote
    {
        return Quote::query()->create($attributes);
    }

    public function update(Quote $quote, array $attributes): Quote
    {
        $quote->update($attributes);

        return $quote;
    }
}
