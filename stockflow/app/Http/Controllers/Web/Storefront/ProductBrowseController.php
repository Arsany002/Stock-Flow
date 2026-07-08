<?php

namespace App\Http\Controllers\Web\Storefront;

use App\Http\Controllers\Controller;
use App\Services\StorefrontCatalogService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Public product listing + detail — no auth, no permission. See Guest
 * rules #2, #4, #5, #6, #7.
 */
class ProductBrowseController extends Controller
{
    public function __construct(private readonly StorefrontCatalogService $catalog) {}

    public function index(Request $request): Response
    {
        $search = $request->string('search')->toString() ?: null;
        $categoryId = $request->string('category_id')->toString() ?: null;

        $products = $this->catalog->listActiveProducts(12, [
            'search' => $search,
            'category_id' => $categoryId,
        ]);

        return Inertia::render('Storefront/Products/Index', [
            'products' => $this->catalog->presentPaginated($products),
            'filters' => ['search' => $search, 'category_id' => $categoryId],
        ]);
    }

    public function show(string $sku): Response
    {
        $product = $this->catalog->findActiveProductBySku($sku);

        abort_unless($product !== null, 404);

        return Inertia::render('Storefront/Products/Show', [
            'product' => $this->catalog->presentProduct($product),
        ]);
    }
}
