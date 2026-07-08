<?php

namespace App\Http\Controllers\Web\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\StorefrontCatalogService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Public category product listing — no auth, no permission. See Guest
 * rule #4. Categories have no is_active column (see
 * docs/project/canonical-decisions.md), so implicit route-model binding
 * by slug is safe here without the scoping concerns that block it for
 * Product (see ProductBrowseController — inactive products must 404).
 */
class CategoryBrowseController extends Controller
{
    public function __construct(private readonly StorefrontCatalogService $catalog) {}

    public function show(Category $category, Request $request): Response
    {
        $search = $request->string('search')->toString() ?: null;

        $products = $this->catalog->listActiveProducts(12, [
            'search' => $search,
            'category_id' => $category->id,
        ]);

        return Inertia::render('Storefront/Categories/Show', [
            'category' => $category->only(['id', 'name', 'slug']),
            'products' => $this->catalog->presentPaginated($products),
            'filters' => ['search' => $search],
        ]);
    }
}
