<?php

namespace Tests\Feature\Security;

use App\Enums\PriceListType;
use App\Enums\UserRole;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\AdaptiveThrottleService;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Laravel\Passport\Passport;
use Tests\TestCase;

/**
 * AdaptiveThrottleService is Cache-backed (via Illuminate's RateLimiter),
 * so these run fine against the suite's default array cache driver — no
 * real Redis needed. Delays are skipped automatically in the `testing`
 * environment (see AdaptiveThrottleService::applyDelay()), so these
 * assert on the `slowed`/blocked meta rather than wall-clock time.
 */
class AdaptiveThrottleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
        config(['abac.throttle_profiles.test_profile' => [
            'window' => 60,
            'slow_after' => 3,
            'block_after' => 5,
            'block_for' => 2,
            'delay_ms' => 100,
        ]]);
    }

    private function requestFrom(string $ip, ?User $user = null): Request
    {
        $request = Request::create('/fake-route', 'POST');
        $request->server->set('REMOTE_ADDR', $ip);

        if ($user !== null) {
            $request->setUserResolver(fn () => $user);
        }

        return $request;
    }

    public function test_a_request_under_threshold_passes(): void
    {
        $service = app(AdaptiveThrottleService::class);
        $request = $this->requestFrom('10.0.0.1');

        $decision = $service->check($request, 'test_profile', 'test.action');

        $this->assertTrue($decision->allowed);
    }

    public function test_a_request_over_block_threshold_returns_429(): void
    {
        $service = app(AdaptiveThrottleService::class);
        $request = $this->requestFrom('10.0.0.2');

        for ($i = 0; $i < 5; $i++) {
            $service->check($request, 'test_profile', 'test.action');
        }

        $decision = $service->check($request, 'test_profile', 'test.action');

        $this->assertFalse($decision->allowed);
        $this->assertSame(429, $decision->httpStatus);
        $this->assertSame('rate_limited_blocked', $decision->code);
    }

    public function test_block_expires_after_the_configured_time(): void
    {
        $service = app(AdaptiveThrottleService::class);
        $request = $this->requestFrom('10.0.0.3');
        $key = $service->key($request, 'test_profile', 'test.action');

        $service->block($key, 1);
        $this->assertTrue($service->isBlocked($key));

        Cache::forget("{$key}:blocked");

        $this->assertFalse($service->isBlocked($key));
    }

    public function test_key_separates_different_users(): void
    {
        $service = app(AdaptiveThrottleService::class);
        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $keyA = $service->key($this->requestFrom('10.0.0.4', $userA), 'test_profile', 'test.action');
        $keyB = $service->key($this->requestFrom('10.0.0.4', $userB), 'test_profile', 'test.action');

        $this->assertNotSame($keyA, $keyB);
    }

    public function test_key_separates_different_actions(): void
    {
        $service = app(AdaptiveThrottleService::class);
        $request = $this->requestFrom('10.0.0.5');

        $keyA = $service->key($request, 'test_profile', 'action.one');
        $keyB = $service->key($request, 'test_profile', 'action.two');

        $this->assertNotSame($keyA, $keyB);
    }

    public function test_guest_ip_throttling_works(): void
    {
        $service = app(AdaptiveThrottleService::class);
        $request = $this->requestFrom('10.0.0.6');

        for ($i = 0; $i < 5; $i++) {
            $service->check($request, 'test_profile', 'test.action');
        }

        $this->assertFalse($service->check($request, 'test_profile', 'test.action')->allowed);
    }

    public function test_authenticated_user_throttling_works(): void
    {
        $service = app(AdaptiveThrottleService::class);
        $user = User::factory()->create();
        $user->addRole(UserRole::RetailCustomer->value);
        $request = $this->requestFrom('10.0.0.7', $user);

        for ($i = 0; $i < 5; $i++) {
            $service->check($request, 'test_profile', 'test.action');
        }

        $this->assertFalse($service->check($request, 'test_profile', 'test.action')->allowed);
    }

    public function test_slowed_meta_is_set_once_slow_after_threshold_is_crossed(): void
    {
        $service = app(AdaptiveThrottleService::class);
        $request = $this->requestFrom('10.0.0.8');

        for ($i = 0; $i < 3; $i++) {
            $service->check($request, 'test_profile', 'test.action');
        }

        $decision = $service->check($request, 'test_profile', 'test.action');

        $this->assertTrue($decision->allowed);
        $this->assertTrue($decision->meta['slowed'] ?? false);
    }

    public function test_cart_mutation_route_is_blocked_by_adaptive_throttle_after_repeated_hits(): void
    {
        $product = Product::factory()->create();
        app(StockService::class)->purchaseIn(
            $product,
            Warehouse::factory()->create(),
            50,
            null,
            null,
        );
        PriceListItem::factory()->create([
            'price_list_id' => PriceList::factory()->create([
                'type' => PriceListType::B2cRetail,
                'is_active' => true,
            ])->id,
            'product_id' => $product->id,
            'unit_price' => '10.00',
            'min_qty' => 1,
        ]);

        for ($i = 0; $i < 40; $i++) {
            $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);
        }

        $this->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1])
            ->assertStatus(429);
    }

    public function test_api_request_over_block_threshold_returns_json_429(): void
    {
        Artisan::call('passport:keys', ['--force' => true]);

        config(['abac.throttle_profiles.api' => [
            'window' => 60,
            'slow_after' => 2,
            'block_after' => 3,
            'block_for' => 60,
            'delay_ms' => 0,
        ]]);

        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);
        Passport::actingAs($user, ['stock:read']);

        for ($i = 0; $i < 3; $i++) {
            $this->getJson('/api/v1/stock/availability');
        }

        $this->getJson('/api/v1/stock/availability')
            ->assertStatus(429)
            ->assertJsonPath('code', 'rate_limited_blocked');
    }

    /**
     * Under the adaptive throttle's block threshold, a webhook with a bad
     * signature still fails signature verification (403 via
     * PaymentVerificationException) rather than being swallowed by, or
     * confused with, throttling — proving the two layers are independent.
     */
    public function test_webhook_throttle_does_not_interfere_with_signature_verification(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/webhooks/v1/paymob', ['transaction' => ['id' => $i]])
                ->assertStatus(403);
        }
    }
}
