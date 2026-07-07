<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function find(string $id): ?Category
    {
        return Category::query()->find($id);
    }

    public function allWithChildren(): Collection
    {
        return Category::query()
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('name')
            ->get();
    }

    public function all(): Collection
    {
        return Category::query()->orderBy('name')->get(['id', 'name', 'parent_id']);
    }

    public function create(array $attributes): Category
    {
        return Category::query()->create($attributes);
    }

    public function update(Category $category, array $attributes): Category
    {
        $category->update($attributes);

        return $category;
    }

    public function delete(Category $category): bool
    {
        return (bool) $category->delete();
    }
}
