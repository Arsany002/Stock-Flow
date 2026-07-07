<?php

namespace App\Http\Controllers\Web\Catalog;

use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\StoreCategoryRequest;
use App\Models\Category;
use App\Models\User;
use App\Services\CatalogService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Categories have no ownership concept and no dedicated Policy — the
 * `category.manage`/`catalog.read` Laratrust permissions (route middleware,
 * plus a direct isAbleTo() check here for defense-in-depth) are the full
 * gate. See docs/project/canonical-decisions.md §2 and StoreCategoryRequest.
 */
class CategoryController extends Controller
{
    public function __construct(private readonly CatalogService $catalog) {}

    public function index(): Response
    {
        $categories = $this->catalog->listCategories()->map(fn (Category $category) => [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'children' => $category->children->map(fn (Category $child) => [
                'id' => $child->id,
                'name' => $child->name,
                'slug' => $child->slug,
            ]),
        ]);

        return Inertia::render('Catalog/Categories/Index', [
            'categories' => $categories,
            'parentOptions' => $this->catalog->listCategoriesFlat()->map->only(['id', 'name']),
        ]);
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $category = $this->catalog->createCategory($request->validated());

        return redirect()
            ->route('catalog.categories.index')
            ->with('flash.success', "Category \"{$category->name}\" created.");
    }

    public function destroy(Category $category): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isAbleTo(PermissionName::CategoryManage->value)) {
            throw new AuthorizationException;
        }

        $this->catalog->deleteCategory($category);

        return redirect()
            ->route('catalog.categories.index')
            ->with('flash.success', 'Category deleted.');
    }
}
