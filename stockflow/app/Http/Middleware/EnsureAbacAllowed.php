<?php

namespace App\Http\Middleware;

use App\Services\AbacService;
use App\Support\Access\AccessContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * `abac:{action}` or `abac:{action},{permission}` — runs AbacService's
 * time-of-day check for the given action. Deliberately separate from (and
 * runs after) Laratrust's `permission:*` middleware: that answers "does
 * this user have this permission", this answers "not right now". Never
 * applied to guest/public routes that must stay always-reachable
 * (storefront browsing) — see routes/web.php.
 */
class EnsureAbacAllowed
{
    public function __construct(private readonly AbacService $abac) {}

    public function handle(Request $request, Closure $next, string $action, ?string $permission = null): Response
    {
        $context = AccessContext::fromRequest($request, $action, $permission);
        $decision = $this->abac->check($context);

        if (! $decision->allowed) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $decision->reason,
                    'code' => $decision->code,
                ], $decision->httpStatus);
            }

            return back()->with('flash.error', $decision->reason);
        }

        return $next($request);
    }
}
