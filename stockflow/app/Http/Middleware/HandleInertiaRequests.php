<?php

namespace App\Http\Middleware;

use App\Services\CartService;
use App\Services\StorefrontCatalogService;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    public function __construct(
        private readonly CartService $cart,
        private readonly StorefrontCatalogService $storefrontCatalog,
    ) {}

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $user?->only(['id', 'name', 'email']),
                // Cosmetic only — the server (route middleware/policies)
                // always re-enforces. See docs/project/canonical-decisions.md §3.
                'roles' => fn () => $user?->roles()->pluck('name')->all() ?? [],
                'permissions' => fn () => $user?->allPermissions()->pluck('name')->all() ?? [],
            ],
            // Populated once warehouse-scoped teams/warehouses exist; null until then.
            'activeWarehouse' => null,
            'flash' => [
                'success' => fn () => $request->session()->get('flash.success'),
                'error' => fn () => $request->session()->get('flash.error'),
            ],
            // Cart is session state (guest or authenticated) — shared
            // everywhere so the storefront header badge doesn't need a
            // dedicated round trip. Session read only, cheap.
            'cart' => [
                'count' => fn () => $this->cart->count(),
                'subtotal' => fn () => $this->cart->subtotal(),
            ],
            // Cached (StorefrontCatalogService -> CatalogService::
            // listCategories(), tag 'catalog') — shared globally so
            // StorefrontLayout's category nav renders on every storefront
            // page without each controller having to pass it explicitly.
            'publicCategories' => fn () => $this->storefrontCatalog->publicCategories(),
        ];
    }
}
