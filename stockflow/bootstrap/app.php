<?php

use App\Exceptions\DomainException;
use App\Exceptions\PaymentVerificationException;
use App\Exceptions\UnauthorizedWarehouseException;
use App\Http\Middleware\AdaptiveThrottle;
use App\Http\Middleware\AuthenticateApiClientCredentials;
use App\Http\Middleware\EnsureAbacAllowed;
use App\Http\Middleware\EnsureApiRequestsJson;
use App\Http\Middleware\EnsureCheckoutIsAuthenticated;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\SecurityHeaders;
use App\Http\Middleware\WarehouseScopeMiddleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Passport\Http\Middleware\CheckToken;
use Laravel\Passport\Http\Middleware\CheckTokenForAnyScope;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function (): void {
            Route::middleware(['api', 'throttle:webhook'])
                ->prefix('webhooks/v1')
                ->group(base_path('routes/webhooks.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Global (web + api + webhooks): every response gets these,
        // including 4xx/5xx error pages and API JSON responses.
        $middleware->append(SecurityHeaders::class);

        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);

        $middleware->alias([
            'api.client-principal' => AuthenticateApiClientCredentials::class,
            'api.json' => EnsureApiRequestsJson::class,
            'checkout.guard' => EnsureCheckoutIsAuthenticated::class,
            'scope' => CheckTokenForAnyScope::class,
            'scopes' => CheckToken::class,
            'warehouse.scope' => WarehouseScopeMiddleware::class,
            'adaptive.throttle' => AdaptiveThrottle::class,
            'abac' => EnsureAbacAllowed::class,
        ]);

        $middleware->prependToPriorityList(
            before: AuthenticatesRequests::class,
            prepend: AuthenticateApiClientCredentials::class,
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->is('webhooks/*'),
        );

        $exceptions->render(function (AuthorizationException $e, Request $request) {
            if ($request->is('api/*')) {
                return null;
            }

            return Inertia::render('Errors/Forbidden')
                ->toResponse($request)
                ->setStatusCode(403);
        });

        $exceptions->render(function (UnauthorizedWarehouseException $e, Request $request) {
            if ($request->is('api/*')) {
                return null;
            }

            return Inertia::render('Errors/Forbidden')
                ->toResponse($request)
                ->setStatusCode(403);
        });

        $exceptions->render(function (PaymentVerificationException $e, Request $request) {
            if ($request->is('api/*') || $request->is('webhooks/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'context' => $e->context(),
                ], 403);
            }

            return back()->with('flash.error', $e->getMessage());
        });

        // Generic fallback for any other domain-rule failure (OutOfStock,
        // PricingUnavailable, InvalidStateTransition, ...) — registered
        // after the more specific UnauthorizedWarehouseException handler
        // above, which still wins for that subtype. Redirects back with a
        // flash error rather than a 500 page, so e.g. checkout failing
        // because a line went out of stock mid-request reads as "cleanly
        // rejected", not "server broke" — see requirement #6 of the B2C
        // checkout module.
        $exceptions->render(function (DomainException $e, Request $request) {
            if ($request->is('api/*') || $request->is('webhooks/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'context' => $e->context(),
                ], 422);
            }

            return back()->with('flash.error', $e->getMessage());
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return null;
            }

            return Inertia::render('Errors/NotFound')
                ->toResponse($request)
                ->setStatusCode(404);
        });
    })->create();
