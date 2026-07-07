<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\Contracts\SupplierRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function find(string $id): ?Supplier
    {
        return Supplier::query()->find($id);
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Supplier::query()->orderBy('name')->paginate($perPage);
    }

    public function all(): Collection
    {
        return Supplier::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']);
    }

    public function create(array $attributes): Supplier
    {
        return Supplier::query()->create($attributes);
    }

    public function update(Supplier $supplier, array $attributes): Supplier
    {
        $supplier->update($attributes);

        return $supplier;
    }

    public function delete(Supplier $supplier): bool
    {
        return (bool) $supplier->delete();
    }
}
