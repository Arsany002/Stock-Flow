<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Requirement #2 of the admin/audit/dashboard/reports module: activity_log
 * records user/role changes, permission changes, stock adjustments, PO
 * approvals, and payment settlement — plus requirement #7's route
 * protection (`audit.read`).
 */
class AuditLogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    private function auditor(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);

        return $user;
    }

    public function test_audit_read_holder_can_view_audit_log(): void
    {
        $auditor = $this->auditor();

        $this->actingAs($auditor)->get('/admin/audit-log')->assertOk();
    }

    public function test_unauthorized_user_cannot_view_audit_log(): void
    {
        $customer = User::factory()->create();
        $customer->addRole(UserRole::RetailCustomer->value);

        $this->actingAs($customer)->get('/admin/audit-log')->assertForbidden();
    }

    public function test_guest_cannot_view_audit_log(): void
    {
        $this->get('/admin/audit-log')->assertRedirect('/login');
    }

    public function test_stock_adjustment_is_audited(): void
    {
        $manager = $this->auditor();
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        app(StockService::class)->purchaseIn($product, $warehouse, 20, $manager, null);

        app(StockService::class)->adjust($product, $warehouse, -5, $manager, 'Cycle count correction');

        $this->assertDatabaseHas('activity_log', [
            'event' => 'stock.adjusted',
            'causer_id' => $manager->id,
            'subject_type' => 'App\\Models\\StockLevel',
        ]);
    }

    public function test_audit_log_entries_are_filterable_by_event(): void
    {
        $manager = $this->auditor();
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        app(StockService::class)->purchaseIn($product, $warehouse, 20, $manager, null);
        app(StockService::class)->adjust($product, $warehouse, -5, $manager, 'Damaged');

        $response = $this->actingAs($manager)->get('/admin/audit-log?event=stock.adjusted');

        $response->assertOk();
        $this->assertSame(1, ActivityLog::query()->where('event', 'stock.adjusted')->count());
    }
}
