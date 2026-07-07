<?php

namespace App\Repositories\Contracts;

use App\Models\Quote;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface QuoteRepositoryInterface
{
    public function find(string $id): ?Quote;

    public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Quotes containing at least one line for a product this vendor
     * supplies — a Vendor's "own pricing context" (see QuotePolicy).
     */
    public function paginateForVendor(int $vendorUserId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Every quote — for staff (Inventory Manager/SuperAdmin) who can price
     * or oversee any quote, not just their own.
     */
    public function paginateAll(int $perPage = 15): LengthAwarePaginator;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Quote;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(Quote $quote, array $attributes): Quote;
}
