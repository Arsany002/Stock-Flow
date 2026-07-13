<?php

namespace App\Support\Access;

use App\Models\User;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Everything AbacService needs to decide "can this user perform this
 * action right now, from this request, under these conditions?" — built
 * once per request by EnsureAbacAllowed from the incoming Request, rather
 * than threaded through as loose parameters.
 */
final class AccessContext
{
    public function __construct(
        public readonly ?User $user,
        public readonly string $ip,
        public readonly ?string $routeName,
        public readonly string $action,
        public readonly ?string $permissionName,
        public readonly Carbon $currentTime,
        public readonly string $timezone,
        public readonly string $requestMethod,
        public readonly string $requestPath,
        public readonly string $guard,
        public readonly mixed $resource = null,
        public readonly ?Warehouse $warehouse = null,
        public readonly ?string $countryCode = null,
    ) {}

    public static function fromRequest(Request $request, string $action, ?string $permissionName = null): self
    {
        $user = $request->user();
        $timezone = config('abac.timezone', 'Africa/Cairo');

        return new self(
            user: $user,
            ip: (string) $request->ip(),
            routeName: $request->route()?->getName(),
            action: $action,
            permissionName: $permissionName,
            currentTime: Carbon::now($timezone),
            timezone: $timezone,
            requestMethod: $request->method(),
            requestPath: $request->path(),
            guard: $request->is('api/*') ? 'api' : ($user ? 'web' : 'guest'),
            countryCode: $request->header('CF-IPCountry') ?: $request->header('X-Country-Code'),
        );
    }
}
