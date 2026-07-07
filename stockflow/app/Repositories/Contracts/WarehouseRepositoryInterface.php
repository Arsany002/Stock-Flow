<?php

namespace App\Repositories\Contracts;

use App\Models\Warehouse;
use Illuminate\Support\Collection;

/**
 * Minimal, read-only: warehouse CRUD isn't part of the stock engine module.
 * Just enough to populate select-dropdowns on the stock pages.
 */
interface WarehouseRepositoryInterface
{
    public function find(string $id): ?Warehouse;

    /**
     * @return Collection<int, Warehouse>
     */
    public function active(): Collection;
}
