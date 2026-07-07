<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function find(string $id): ?Category;

    /**
     * All categories with their children eager-loaded, for building a
     * nested tree client-side.
     *
     * @return Collection<int, Category>
     */
    public function allWithChildren(): Collection;

    /**
     * Flat, minimal list for select-dropdown use.
     *
     * @return Collection<int, Category>
     */
    public function all(): Collection;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function create(array $attributes): Category;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function update(Category $category, array $attributes): Category;

    public function delete(Category $category): bool;
}
