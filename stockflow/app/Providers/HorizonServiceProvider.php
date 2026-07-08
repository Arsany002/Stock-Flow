<?php

namespace App\Providers;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        // Horizon::routeSmsNotificationsTo('15556667777');
        // Horizon::routeMailNotificationsTo('example@example.com');
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');
    }

    /**
     * Register the Horizon gate.
     *
     * Horizon exposes queue throughput, job payloads, and failure details —
     * infra-level visibility with no equivalent in the PRD's permission
     * matrix, so it's restricted to SuperAdmin directly rather than added as
     * a new granular permission for a single dashboard.
     */
    protected function gate(): void
    {
        Gate::define('viewHorizon', function ($user = null) {
            return (bool) $user?->hasRole(UserRole::SuperAdmin->value);
        });
    }
}
