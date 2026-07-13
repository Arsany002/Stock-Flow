<?php

namespace App\Support\Access;

/**
 * The result of an AbacService::check() or AdaptiveThrottleService::check()
 * call. Deliberately a plain immutable value object (not an exception) —
 * both EnsureAbacAllowed and AdaptiveThrottle middleware branch on
 * ->allowed themselves so they can shape a web (Inertia flash-redirect) or
 * API (JSON) response with the right status code, rather than relying on
 * bootstrap/app.php's generic DomainException renderer.
 */
final class AccessDecision
{
    /**
     * @param  array<string, mixed>  $meta
     */
    private function __construct(
        public readonly bool $allowed,
        public readonly string $reason,
        public readonly string $code,
        public readonly int $httpStatus,
        public readonly array $meta = [],
    ) {}

    /**
     * @param  array<string, mixed>  $meta
     */
    public static function allow(array $meta = []): self
    {
        return new self(true, '', 'allowed', 200, $meta);
    }

    /**
     * @param  array<string, mixed>  $meta
     */
    public static function deny(string $reason, string $code, int $httpStatus = 403, array $meta = []): self
    {
        return new self(false, $reason, $code, $httpStatus, $meta);
    }
}
