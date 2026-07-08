<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\Warehouse;
use App\Policies\OrderPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\PriceListPolicy;
use App\Policies\ProductPolicy;
use App\Policies\PurchaseOrderPolicy;
use App\Policies\QuotePolicy;
use App\Policies\StockPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        Passport::enablePasswordGrant();
        Passport::$revokeRefreshTokenAfterUse = true;
        Passport::tokensExpireIn(now()->addMinutes(15));
        Passport::clientCredentialsTokensExpireIn(now()->addMinutes(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::tokensCan([
            'catalog:read' => 'Read product catalog data',
            'orders:write' => 'Create B2B quote/order workflow records',
            'stock:read' => 'Read stock availability',
            'payments:write' => 'Create B2B bank transfer payment proofs',
        ]);

        RateLimiter::for('api', function (Request $request) {
            $identifier = $request->user('api')?->getAuthIdentifier() ?: $request->ip();

            return Limit::perMinute(120)->by((string) $identifier);
        });

        // Brute-force protection: keyed by IP + attempted email together, so
        // one attacker IP can't lock out a legitimate user's email (a
        // per-email-only limit would let an attacker DoS a known user by
        // spamming failed logins), and one email being hammered from many
        // IPs still gets rate-limited per source. This is currently the
        // only login-attempt throttle — AuthService itself has no separate
        // lockout, so don't remove this without adding an equivalent.
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->string('email');

            return Limit::perMinute(5)->by($request->ip().'|'.$email);
        });

        // Checkout creates a real Order + reserves stock on every request —
        // keyed per authenticated user (checkout always requires
        // `sale.create`, so a user is always present) rather than IP, so
        // shared-IP customers (offices, NAT) don't throttle each other.
        RateLimiter::for('checkout', function (Request $request) {
            return Limit::perMinute(10)->by((string) $request->user()?->id);
        });

        // Cart mutations (add/update/remove/clear) are reachable by guests
        // with no login at all, so unlike 'checkout' this can't key on a
        // guaranteed user id — falls back to IP for anonymous carts, user
        // id once authenticated (so logging in doesn't reset a guest's
        // remaining quota mid-session at the same IP).
        RateLimiter::for('cart', function (Request $request) {
            return Limit::perMinute(30)->by((string) ($request->user()?->id ?: $request->ip()));
        });

        // Payment webhooks are server-to-server (Paymob/Fawry/the Fake
        // Gateway simulator), not interactive traffic — generous enough
        // that a legitimate retry storm from a gateway provider doesn't get
        // dropped, but bounded so a misconfigured or malicious sender can't
        // hammer PaymentService::verifyWebhook() indefinitely. Keyed by IP;
        // webhook payloads are signature-verified separately (see
        // app/Payments/*Gateway.php), so this is throughput protection, not
        // authentication.
        RateLimiter::for('webhook', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });

        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(PriceList::class, PriceListPolicy::class);
        // PriceListPolicy also covers PriceListItem (own-item checks) —
        // see docs/project/canonical-decisions.md §2 and the policy's docblock.
        Gate::policy(PriceListItem::class, PriceListPolicy::class);
        Gate::policy(Warehouse::class, StockPolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Payment::class, PaymentPolicy::class);
        Gate::policy(Quote::class, QuotePolicy::class);
        Gate::policy(PurchaseOrder::class, PurchaseOrderPolicy::class);
    }
}
