<?php

namespace App\Http\Middleware;

use App\Services\AdaptiveThrottleService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * `adaptive.throttle:{profile},{action}` — progressive rate protection on
 * top of (not instead of) the existing named `throttle:*` rate limiters in
 * AppServiceProvider. Those are hard per-minute caps; this adds a
 * slow-down zone before the hard block, and remembers a block across the
 * profile's configured `block_for` window even after the hit counter
 * itself decays.
 */
class AdaptiveThrottle
{
    public function __construct(private readonly AdaptiveThrottleService $throttle) {}

    public function handle(Request $request, Closure $next, string $profile, string $action): Response
    {
        $decision = $this->throttle->check($request, $profile, $action);

        if (! $decision->allowed) {
            if ($request->is('api/*') || $request->is('webhooks/*') || $request->expectsJson()) {
                return response()->json([
                    'message' => $decision->reason,
                    'code' => $decision->code,
                ], $decision->httpStatus);
            }

            if ($request->header('X-Inertia')) {
                return back()->with('flash.error', $decision->reason);
            }

            return response($decision->reason, $decision->httpStatus);
        }

        return $next($request);
    }
}
