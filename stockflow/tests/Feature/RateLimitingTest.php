<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

/**
 * Hardening requirement #6/#9: login, checkout, and payment-webhook routes
 * are rate limited (see AppServiceProvider::boot()). /api/v1's `api`
 * limiter already existed and is covered by tests/Feature/Api.
 */
class RateLimitingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_login_is_rate_limited_per_ip_and_email(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => 'nobody@test.com', 'password' => 'wrong'])
                ->assertStatus(302);
        }

        $this->post('/login', ['email' => 'nobody@test.com', 'password' => 'wrong'])
            ->assertStatus(429);
    }

    public function test_login_rate_limit_is_scoped_per_email_not_globally(): void
    {
        RateLimiter::clear('login');

        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => 'victim@test.com', 'password' => 'wrong'])
                ->assertStatus(302);
        }

        // A different email from the same IP is not caught by the first
        // email's lockout.
        $this->post('/login', ['email' => 'someone-else@test.com', 'password' => 'wrong'])
            ->assertStatus(302);
    }

    public function test_checkout_is_rate_limited_per_user(): void
    {
        $customer = User::factory()->create();
        $customer->addRole(UserRole::RetailCustomer->value);

        for ($i = 0; $i < 10; $i++) {
            $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);
        }

        $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod'])
            ->assertStatus(429);
    }

    public function test_payment_webhook_is_rate_limited_per_ip(): void
    {
        for ($i = 0; $i < 60; $i++) {
            $this->postJson('/webhooks/v1/fake-gateway', []);
        }

        $this->postJson('/webhooks/v1/fake-gateway', [])
            ->assertStatus(429);
    }

    /**
     * The adaptive throttle's `payment` profile (block_after=40, see
     * config/abac.php) now sits in front of the plain 60/min named
     * `throttle:webhook` limiter above and triggers first — see
     * AdaptiveThrottle middleware in routes/webhooks.php.
     */
    public function test_payment_webhook_is_blocked_by_adaptive_throttle_before_the_named_limiter(): void
    {
        for ($i = 0; $i < 40; $i++) {
            $this->postJson('/webhooks/v1/fake-gateway', []);
        }

        $this->postJson('/webhooks/v1/fake-gateway', [])
            ->assertStatus(429)
            ->assertJson(['code' => 'rate_limited_blocked']);
    }
}
