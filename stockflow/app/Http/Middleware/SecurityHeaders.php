<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->headers->set('Content-Security-Policy', $this->contentSecurityPolicy());

        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }

    private function contentSecurityPolicy(): string
    {
        $isLocal = app()->environment(['local', 'testing']);
        $viteOrigins = [
            'http://localhost:5173',
            'http://127.0.0.1:5173',
            'ws://localhost:5173',
            'ws://127.0.0.1:5173',
        ];

        $scriptSrc = ["'self'"];
        $styleSrc = ["'self'", "'unsafe-inline'"];
        $connectSrc = ["'self'"];

        if ($isLocal) {
            $scriptSrc = array_merge($scriptSrc, ["'unsafe-inline'", "'unsafe-eval'", 'http://localhost:5173', 'http://127.0.0.1:5173']);
            $connectSrc = array_merge($connectSrc, $viteOrigins);
        }

        return collect([
            'default-src' => ["'self'"],
            'script-src' => $scriptSrc,
            'style-src' => $styleSrc,
            'img-src' => ["'self'", 'data:', 'https:'],
            'font-src' => ["'self'", 'data:'],
            'connect-src' => $connectSrc,
            'frame-ancestors' => ["'none'"],
        ])
            ->map(fn (array $values, string $directive) => $directive.' '.implode(' ', $values))
            ->implode('; ');
    }
}
