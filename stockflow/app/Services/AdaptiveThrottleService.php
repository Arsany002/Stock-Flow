<?php

namespace App\Services;

use App\Support\Access\AccessDecision;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * Rate protection answers "is this user/IP hitting this action too
 * aggressively?" — orthogonal to AbacService (time-of-day) and Laratrust
 * (permissions). Keys are scoped by profile + action + route + identity
 * (user id when authenticated, otherwise IP), so one guest hammering
 * /cart/items doesn't throttle a different guest, and hitting
 * stock.move heavily doesn't consume the same budget as po.approve.
 *
 * Uses Illuminate's RateLimiter (Cache-backed, so it works against the
 * array driver in tests and Redis in prod) for the hit counter, plus a
 * plain Cache key for the hard-block flag so a block outlives the hit
 * counter's own decay window.
 */
class AdaptiveThrottleService
{
    public function __construct(
        private readonly RateLimiter $limiter,
        private readonly AuditService $audit,
    ) {}

    public function check(Request $request, string $profile, string $action): AccessDecision
    {
        $key = $this->key($request, $profile, $action);

        if ($this->isBlocked($key)) {
            return AccessDecision::deny(
                'Too many requests. Please try again later.',
                'rate_limited_blocked',
                429,
                ['profile' => $profile, 'action' => $action],
            );
        }

        $config = $this->profileConfig($profile);
        $count = $this->hit($request, $profile, $action);

        if ($count > $config['block_after']) {
            $this->block($key, $config['block_for']);

            $this->audit->record('security.rate_limit_blocked', null, $request->user(), [
                'profile' => $profile,
                'action' => $action,
                'ip' => $request->ip(),
                'route' => $request->route()?->getName(),
                'hits' => $count,
            ]);

            return AccessDecision::deny(
                'Too many requests. Please try again later.',
                'rate_limited_blocked',
                429,
                ['profile' => $profile, 'action' => $action],
            );
        }

        if ($count > $config['slow_after']) {
            $this->applyDelay($config['delay_ms']);

            return AccessDecision::allow(['slowed' => true, 'hits' => $count]);
        }

        return AccessDecision::allow(['hits' => $count]);
    }

    /**
     * Increments the hit counter for this (profile, action, identity)
     * tuple and returns the new count. Decays automatically after
     * the profile's configured window.
     */
    public function hit(Request $request, string $profile, string $action): int
    {
        $key = $this->key($request, $profile, $action);
        $window = $this->profileConfig($profile)['window'];

        return $this->limiter->hit($key, $window);
    }

    public function key(Request $request, string $profile, string $action): string
    {
        $identity = $request->user()?->getAuthIdentifier() ?? ('ip:'.$request->ip());
        $routeName = $request->route()?->getName() ?? $request->path();

        return "abac_throttle:{$profile}:{$action}:{$routeName}:{$identity}";
    }

    public function isBlocked(string $key): bool
    {
        return Cache::has("{$key}:blocked");
    }

    public function block(string $key, int $seconds): void
    {
        Cache::put("{$key}:blocked", true, $seconds);
    }

    /**
     * @return array{window: int, slow_after: int, block_after: int, block_for: int, delay_ms: int}
     */
    private function profileConfig(string $profile): array
    {
        return config("abac.throttle_profiles.{$profile}") ?? [
            'window' => 60,
            'slow_after' => 60,
            'block_after' => 120,
            'block_for' => 300,
            'delay_ms' => 250,
        ];
    }

    /**
     * Never sleeps during tests — the delay is a UX/anti-automation
     * measure, not something a test suite should have to wait through, and
     * PHPUnit can assert on the AccessDecision's `slowed` meta flag instead
     * of wall-clock time.
     */
    private function applyDelay(int $milliseconds): void
    {
        if (app()->environment('testing') || $milliseconds <= 0) {
            return;
        }

        usleep($milliseconds * 1000);
    }
}
