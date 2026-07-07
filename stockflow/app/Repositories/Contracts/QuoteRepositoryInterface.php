<?php

namespace App\Repositories\Contracts;

use App\Models\Quote;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface QuoteRepositoryInterface
{
    public function find(string $id): ?Quote;

    public function paginateForBusinessAccount(string $businessAccountId, int $perPage = 15): LengthAwarePaginator;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Quote;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(Quote $quote, array $attributes): Quote;
}
