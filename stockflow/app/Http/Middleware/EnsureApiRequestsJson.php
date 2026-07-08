<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiRequestsJson
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->expectsJson() && ! $request->acceptsAnyContentType()) {
            return response()->json([
                'message' => 'The API only serves JSON. Send Accept: application/json.',
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        if (in_array($request->method(), ['POST', 'PUT', 'PATCH'], true)
            && $request->getContent() !== ''
            && ! $request->isJson()) {
            return response()->json([
                'message' => 'The API only accepts JSON request bodies.',
            ], Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        return $next($request);
    }
}
