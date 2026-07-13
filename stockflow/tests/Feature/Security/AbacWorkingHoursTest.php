<?php

namespace Tests\Feature\Security;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\BusinessAccount;
use App\Models\PermissionAccessWindow;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\AbacService;
use App\Support\Access\AccessAction;
use App\Support\Access\AccessContext;
use Carbon\Carbon;
use Database\Seeders\CompanyWorkingHourSeeder;
use Database\Seeders\PermissionAccessWindowSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Tests\Concerns\SetsUpCheckoutFixtures;
use Tests\TestCase;

/**
 * Company schedule (CompanyWorkingHourSeeder): Sun-Thu + Sat 09:00-18:00
 * Africa/Cairo, Friday closed. 2026-07-12 is a Sunday, 2026-07-17 is a
 * Friday, 2026-07-18 is a Saturday (fixed reference dates so tests don't
 * depend on "today").
 */
class AbacWorkingHoursTest extends TestCase
{
    use RefreshDatabase, SetsUpCheckoutFixtures;

    private static bool $passportKeysGenerated = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
        $this->seed(CompanyWorkingHourSeeder::class);
        $this->seed(PermissionAccessWindowSeeder::class);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    private function inventoryManager(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);

        return $user;
    }

    public function test_action_with_no_specific_window_is_allowed_during_company_working_hours(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 12, 10, 0, 0, 'Africa/Cairo'));

        $context = new AccessContext(
            user: $this->inventoryManager(),
            ip: '127.0.0.1',
            routeName: null,
            action: AccessAction::QUOTE_PRICE,
            permissionName: PermissionName::QuotePrice->value,
            currentTime: Carbon::now('Africa/Cairo'),
            timezone: 'Africa/Cairo',
            requestMethod: 'POST',
            requestPath: 'procurement/quotes/1/price',
            guard: 'web',
        );

        $this->assertTrue(app(AbacService::class)->check($context)->allowed);
    }

    public function test_action_with_no_specific_window_is_blocked_outside_company_working_hours(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 12, 20, 0, 0, 'Africa/Cairo'));

        $context = new AccessContext(
            user: $this->inventoryManager(),
            ip: '127.0.0.1',
            routeName: null,
            action: AccessAction::QUOTE_PRICE,
            permissionName: PermissionName::QuotePrice->value,
            currentTime: Carbon::now('Africa/Cairo'),
            timezone: 'Africa/Cairo',
            requestMethod: 'POST',
            requestPath: 'procurement/quotes/1/price',
            guard: 'web',
        );

        $decision = app(AbacService::class)->check($context);

        $this->assertFalse($decision->allowed);
        $this->assertSame('outside_working_hours', $decision->code);
    }

    public function test_friday_closed_blocks_a_protected_action(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 17, 10, 0, 0, 'Africa/Cairo'));

        $context = new AccessContext(
            user: $this->inventoryManager(),
            ip: '127.0.0.1',
            routeName: null,
            action: AccessAction::QUOTE_PRICE,
            permissionName: PermissionName::QuotePrice->value,
            currentTime: Carbon::now('Africa/Cairo'),
            timezone: 'Africa/Cairo',
            requestMethod: 'POST',
            requestPath: 'procurement/quotes/1/price',
            guard: 'web',
        );

        $decision = app(AbacService::class)->check($context);

        $this->assertFalse($decision->allowed);
        $this->assertSame('outside_working_hours', $decision->code);
    }

    public function test_permission_specific_window_overrides_the_global_company_window(): void
    {
        // stock.move's seeded window is 09:00-17:00 Sat-Thu, narrower than
        // the 09:00-18:00 company default — 17:30 is inside company hours
        // but outside stock.move's own window, so the specific window
        // must win.
        Carbon::setTestNow(Carbon::create(2026, 7, 12, 17, 30, 0, 'Africa/Cairo'));

        $context = new AccessContext(
            user: $this->inventoryManager(),
            ip: '127.0.0.1',
            routeName: null,
            action: AccessAction::STOCK_MOVE,
            permissionName: PermissionName::StockMove->value,
            currentTime: Carbon::now('Africa/Cairo'),
            timezone: 'Africa/Cairo',
            requestMethod: 'POST',
            requestPath: 'stock/adjustments',
            guard: 'web',
        );

        $decision = app(AbacService::class)->check($context);

        $this->assertFalse($decision->allowed);
        $this->assertSame('outside_permission_window', $decision->code);
    }

    public function test_overnight_access_window_works_across_midnight(): void
    {
        PermissionAccessWindow::query()->create([
            'permission_name' => PermissionName::AuditRead->value,
            'action' => 'audit.overnight-check',
            'role_id' => null,
            'day_of_week' => 6, // Saturday
            'starts_at' => '22:00:00',
            'ends_at' => '06:00:00',
            'timezone' => 'Africa/Cairo',
            'is_active' => true,
            'bypass_for_super_admin' => true,
        ]);

        $user = $this->inventoryManager();
        $abac = app(AbacService::class);

        $makeContext = fn () => new AccessContext(
            user: $user,
            ip: '127.0.0.1',
            routeName: null,
            action: 'audit.overnight-check',
            permissionName: PermissionName::AuditRead->value,
            currentTime: Carbon::now('Africa/Cairo'),
            timezone: 'Africa/Cairo',
            requestMethod: 'GET',
            requestPath: 'admin/audit-log',
            guard: 'web',
        );

        // Saturday 23:30 — the "starts_at -> midnight" half of the window.
        Carbon::setTestNow(Carbon::create(2026, 7, 18, 23, 30, 0, 'Africa/Cairo'));
        $this->assertTrue($abac->check($makeContext())->allowed);

        // Sunday 02:00 — the "midnight -> ends_at" half, on the calendar
        // day *after* the window's configured day_of_week (Saturday=6).
        Carbon::setTestNow(Carbon::create(2026, 7, 19, 2, 0, 0, 'Africa/Cairo'));
        $this->assertTrue($abac->check($makeContext())->allowed);

        // Sunday 10:00 — outside the window entirely.
        Carbon::setTestNow(Carbon::create(2026, 7, 19, 10, 0, 0, 'Africa/Cairo'));
        $this->assertFalse($abac->check($makeContext())->allowed);
    }

    public function test_super_admin_bypasses_time_window_rule_when_configured(): void
    {
        config(['abac.super_admin_bypass_time_windows' => true]);

        Carbon::setTestNow(Carbon::create(2026, 7, 17, 10, 0, 0, 'Africa/Cairo')); // Friday, closed

        $admin = User::factory()->create();
        $admin->addRole(UserRole::SuperAdmin->value);

        $context = new AccessContext(
            user: $admin,
            ip: '127.0.0.1',
            routeName: null,
            action: AccessAction::QUOTE_PRICE,
            permissionName: PermissionName::QuotePrice->value,
            currentTime: Carbon::now('Africa/Cairo'),
            timezone: 'Africa/Cairo',
            requestMethod: 'POST',
            requestPath: 'procurement/quotes/1/price',
            guard: 'web',
        );

        $this->assertTrue(app(AbacService::class)->check($context)->allowed);
    }

    public function test_non_super_admin_cannot_bypass_time_window_rule(): void
    {
        config(['abac.super_admin_bypass_time_windows' => true]);

        Carbon::setTestNow(Carbon::create(2026, 7, 17, 10, 0, 0, 'Africa/Cairo')); // Friday, closed

        $context = new AccessContext(
            user: $this->inventoryManager(),
            ip: '127.0.0.1',
            routeName: null,
            action: AccessAction::QUOTE_PRICE,
            permissionName: PermissionName::QuotePrice->value,
            currentTime: Carbon::now('Africa/Cairo'),
            timezone: 'Africa/Cairo',
            requestMethod: 'POST',
            requestPath: 'procurement/quotes/1/price',
            guard: 'web',
        );

        $this->assertFalse(app(AbacService::class)->check($context)->allowed);
    }

    public function test_api_request_outside_allowed_window_returns_json_403(): void
    {
        if (! self::$passportKeysGenerated) {
            Artisan::call('passport:keys', ['--force' => true]);
            self::$passportKeysGenerated = true;
        }

        Carbon::setTestNow(Carbon::create(2026, 7, 17, 10, 0, 0, 'Africa/Cairo')); // Friday, closed

        $buyer = User::factory()->create();
        $buyer->addRole(UserRole::BusinessBuyer->value);
        BusinessAccount::factory()->create(['user_id' => $buyer->id]);

        Passport::actingAs($buyer, ['orders:write']);

        $response = $this->postJson('/api/v1/b2b/quotes', [
            'lines' => [],
        ]);

        // quote.request has no permission-specific window seeded, so this
        // falls back to company_working_hours — Friday is closed.
        $response->assertStatus(403);
        $response->assertJsonPath('code', 'outside_working_hours');
    }

    public function test_web_request_outside_allowed_window_redirects_with_flash_error(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 17, 10, 0, 0, 'Africa/Cairo')); // Friday

        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $manager = User::factory()->create();
        $manager->addRole(UserRole::InventoryManager->value, $warehouse->fresh()->team);

        $response = $this->actingAs($manager)->post('/stock/adjustments', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 5,
            'reason' => 'Friday attempt',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error');
        $this->assertDatabaseMissing('stock_movements', ['product_id' => $product->id]);
    }

    // ---- Integration tests -------------------------------------------------

    public function test_inventory_manager_is_blocked_outside_the_stock_move_window(): void
    {
        // stock.move's window is Sat-Thu 09:00-17:00 — 18:00 is outside it
        // even though the wider company schedule (09:00-18:00) is still open.
        Carbon::setTestNow(Carbon::create(2026, 7, 12, 18, 0, 0, 'Africa/Cairo'));

        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $manager = User::factory()->create();
        $manager->addRole(UserRole::InventoryManager->value, $warehouse->fresh()->team);

        $response = $this->actingAs($manager)->post('/stock/adjustments', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 5,
            'reason' => 'After hours attempt',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error');
        $this->assertDatabaseMissing('stock_movements', ['product_id' => $product->id]);
    }

    public function test_inventory_manager_is_allowed_during_the_stock_move_window(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 12, 11, 0, 0, 'Africa/Cairo'));

        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $manager = User::factory()->create();
        $manager->addRole(UserRole::InventoryManager->value, $warehouse->fresh()->team);

        $response = $this->actingAs($manager)->post('/stock/adjustments', [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => 5,
            'reason' => 'In-window adjustment',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('stock_movements', ['product_id' => $product->id, 'warehouse_id' => $warehouse->id]);
    }

    public function test_retail_customer_can_browse_products_outside_working_hours(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 17, 3, 0, 0, 'Africa/Cairo')); // Friday, closed, 3am

        ['product' => $product] = $this->productWithRetailStock(quantity: 5, price: '50.00');

        // Guest, no auth at all — storefront browsing only ever gets
        // adaptive.throttle, never `abac`.
        $this->get('/products')->assertOk();
        $this->get("/products/{$product->sku}")->assertOk();
    }

    public function test_retail_customer_cannot_confirm_checkout_outside_the_checkout_confirm_window(): void
    {
        // checkout.confirm's window is Sat-Thu 09:00-23:00, Friday
        // 12:00-23:00 — Friday 08:00 is before that day's window opens.
        Carbon::setTestNow(Carbon::create(2026, 7, 17, 8, 0, 0, 'Africa/Cairo'));

        $customer = $this->retailCustomer();
        ['product' => $product] = $this->productWithRetailStock(quantity: 10, price: '100.00');

        $this->actingAs($customer)->post('/cart/items', ['product_id' => $product->id, 'quantity' => 1]);

        $response = $this->actingAs($customer)->post('/checkout', ['payment_method' => 'cod']);

        $response->assertRedirect();
        $response->assertSessionHas('flash.error');
        $this->assertDatabaseMissing('orders', ['user_id' => $customer->id]);
    }

    /**
     * Proves webhooks are never gated by company_working_hours: at
     * Friday 3am (closed for every other module in this test class), the
     * fake-gateway webhook still reaches PaymentService's own domain
     * validation (a normal "missing payment_id" rejection) rather than
     * being redirected/blocked by ABAC's "outside_working_hours" rule —
     * see routes/webhooks.php.
     */
    public function test_payment_webhook_still_reaches_domain_validation_outside_working_hours(): void
    {
        Carbon::setTestNow(Carbon::create(2026, 7, 17, 3, 0, 0, 'Africa/Cairo')); // Friday, closed, 3am

        $response = $this->postJson('/webhooks/v1/fake-gateway', []);

        $response->assertStatus(403);
        $response->assertJsonPath('message', 'Fake gateway webhook is missing payment_id.');
    }
}
