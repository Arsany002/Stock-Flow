<?php

namespace App\Http\Controllers\Web\Storefront;

use App\Http\Controllers\Controller;
use App\Services\StorefrontCatalogService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Public product search — no auth, no permission. See Guest rule #3.
 * Kept as a distinct page/route from Storefront/Products/Index (which also
 * accepts a `search` filter) because a dedicated /search URL is what the
 * storefront's search box submits to, and keeps that intent separate from
 * "browsing the full catalog with a filter applied".
 */
class SearchController extends Controller
{
    public function __construct(private readonly StorefrontCatalogService $catalog) {}

    public function index(Request $request): Response
    {
        $query = $request->string('q')->toString() ?: null;

        $products = $query !== null
            ? $this->catalog->presentPaginated($this->catalog->listActiveProducts(12, ['search' => $query]))
            : null;

        return Inertia::render('Storefront/Search', [
            'query' => $query ?? '',
            'products' => $products,
        ]);
    }
}
