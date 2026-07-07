<?php

namespace App\Repositories;

use App\Models\Warehouse;
use App\Repositories\Contracts\WarehouseRepositoryInterface;
use Illuminate\Support\Collection;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    public function find(string $id): ?Warehouse
    {
        return Warehouse::query()->find($id);
    }

    public function active(): Collection
    {
        return Warehouse::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'code']);
    }
}
