<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Baseline security headers for every response (web, api, webhooks).
 *
 * No CSP here: Inertia/Vite inject per-request script nonces nowhere in
 * this app yet, and the React bundle relies on inline style attributes
 * from a couple of UI libraries — a naive CSP would break the app rather
 * than harden it. The headers below are safe defaults with no such
 * trade-off. Revisit CSP as a dedicated task once nonce plumbing exists.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
