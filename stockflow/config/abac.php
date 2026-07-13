<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default timezone for working-hour / access-window evaluation
    |--------------------------------------------------------------------------
    */
    'timezone' => env('ABAC_TIMEZONE', 'Africa/Cairo'),

    /*
    |--------------------------------------------------------------------------
    | SuperAdmin bypass
    |--------------------------------------------------------------------------
    |
    | SuperAdmin bypasses working-hour / access-window time restrictions by
    | default (requirement #3). It deliberately has NO equivalent toggle
    | for adaptive throttling below other than the explicit
    | `super_admin_bypass_rate_limiting` flag, which defaults to false —
    | abuse/rate protection is not a permission and must not be silently
    | bypassable just by holding the highest role.
    |
    */
    'super_admin_bypass_time_windows' => env('ABAC_SUPER_ADMIN_BYPASS_TIME_WINDOWS', true),

    'super_admin_bypass_rate_limiting' => env('ABAC_SUPER_ADMIN_BYPASS_RATE_LIMITING', false),

    /*
    |--------------------------------------------------------------------------
    | Adaptive throttle profiles
    |--------------------------------------------------------------------------
    |
    | window: seconds the hit counter accumulates over before resetting.
    | slow_after: hit count beyond which an artificial delay is added.
    | block_after: hit count beyond which the caller is hard-blocked.
    | block_for: seconds a hard block lasts once triggered.
    | delay_ms: artificial delay applied once slow_after is crossed
    |           (skipped entirely when running the test suite).
    |
    */
    'throttle_profiles' => [
        'public_read' => [
            'window' => 60,
            'slow_after' => 120,
            'block_after' => 240,
            'block_for' => 300,
            'delay_ms' => 250,
        ],
        'cart_mutation' => [
            'window' => 60,
            'slow_after' => 20,
            'block_after' => 40,
            'block_for' => 600,
            'delay_ms' => 500,
        ],
        'auth' => [
            'window' => 60,
            'slow_after' => 5,
            'block_after' => 10,
            'block_for' => 900,
            'delay_ms' => 1000,
        ],
        'checkout' => [
            'window' => 60,
            'slow_after' => 10,
            'block_after' => 20,
            'block_for' => 900,
            'delay_ms' => 750,
        ],
        'payment' => [
            'window' => 60,
            'slow_after' => 20,
            'block_after' => 40,
            'block_for' => 900,
            'delay_ms' => 500,
        ],
        'stock' => [
            'window' => 60,
            'slow_after' => 30,
            'block_after' => 60,
            'block_for' => 900,
            'delay_ms' => 500,
        ],
        'admin' => [
            'window' => 60,
            'slow_after' => 40,
            'block_after' => 80,
            'block_for' => 900,
            'delay_ms' => 500,
        ],
        'api' => [
            'window' => 60,
            'slow_after' => 60,
            'block_after' => 120,
            'block_for' => 900,
            'delay_ms' => 250,
        ],
    ],
];
