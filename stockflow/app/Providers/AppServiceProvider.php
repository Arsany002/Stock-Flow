<?php

namespace App\Providers;

use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\Warehouse;
use App\Policies\PriceListPolicy;
use App\Policies\ProductPolicy;
use App\Policies\StockPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(PriceList::class, PriceListPolicy::class);
        // PriceListPolicy also covers PriceListItem (own-item checks) —
        // see docs/project/canonical-decisions.md §2 and the policy's docblock.
        Gate::policy(PriceListItem::class, PriceListPolicy::class);
        Gate::policy(Warehouse::class, StockPolicy::class);
    }
}
