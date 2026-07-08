<?php

namespace App\Http\Middleware;

use App\Auth\ApiClientPrincipal;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\AccessToken;
use Laravel\Passport\ClientRepository;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\ResourceServer;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApiClientCredentials
{
    public function __construct(
        private readonly ClientRepository $clients,
        private readonly ResourceServer $server,
    ) {}

    /**
     * Allow Passport client-credentials tokens to satisfy `auth:api` as a
     * scoped, read-only machine principal. User bearer tokens are left to the
     * normal Passport guard.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->bearerToken() || Auth::guard('api')->user()) {
            return $next($request);
        }

        $psrRequest = (new PsrHttpFactory)->createRequest($request);

        try {
            $psrRequest = $this->server->validateAuthenticatedRequest($psrRequest);
        } catch (OAuthServerException) {
            return $next($request);
        }

        $oauthUserId = $psrRequest->getAttribute('oauth_user_id');
        $clientId = $psrRequest->getAttribute('oauth_client_id');

        if (! empty($oauthUserId) || empty($clientId)) {
            return $next($request);
        }

        $client = $this->clients->findActive($clientId);

        if (! $client?->hasGrantType('client_credentials')) {
            return $next($request);
        }

        $principal = (new ApiClientPrincipal($client))
            ->withAccessToken(AccessToken::fromPsrRequest($psrRequest));

        Auth::guard('api')->setUser($principal);

        return $next($request);
    }
}
