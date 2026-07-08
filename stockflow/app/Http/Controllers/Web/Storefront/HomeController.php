<?php

namespace App\Http\Controllers\Web\Storefront;

use App\Http\Controllers\Controller;
use App\Services\StorefrontCatalogService;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Public home page — no auth, no permission. See Guest rule #1.
 */
class HomeController extends Controller
{
    public function __construct(private readonly StorefrontCatalogService $catalog) {}

    public function __invoke(): Response
    {
        $featured = $this->catalog->listActiveProducts(8);

        return Inertia::render('Storefront/Home', [
            'featuredProducts' => $this->catalog->presentPaginated($featured)->items(),
        ]);
    }
}
