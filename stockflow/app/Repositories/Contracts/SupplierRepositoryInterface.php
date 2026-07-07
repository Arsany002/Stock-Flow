<?php

namespace App\Repositories\Contracts;

use App\Models\Supplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SupplierRepositoryInterface
{
    public function find(string $id): ?Supplier;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    /**
     * Flat, minimal list for select-dropdown use.
     *
     * @return Collection<int, Supplier>
     */
    public function all(): Collection;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Supplier;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(Supplier $supplier, array $attributes): Supplier;

    public function delete(Supplier $supplier): bool;
}
