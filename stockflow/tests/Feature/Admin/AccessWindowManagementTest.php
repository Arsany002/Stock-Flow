<?php

namespace Tests\Feature\Admin;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\PermissionAccessWindow;
use App\Models\User;
use Database\Seeders\CompanyWorkingHourSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Admin UI for company_working_hours + permission_access_windows — gated
 * by `access.manage`, which only SuperAdmin holds by default (see
 * RolePermissionSeeder — no other role's matrix entry lists it).
 */
class AccessWindowManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
        $this->seed(CompanyWorkingHourSeeder::class);
    }

    private function superAdmin(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::SuperAdmin->value);

        return $user;
    }

    public function test_super_admin_can_view_company_working_hours(): void
    {
        $response = $this->actingAs($this->superAdmin())->get('/admin/access/company-hours');

        $response->assertOk();
        $response->assertInertia(fn ($page) => $page->component('Admin/Access/CompanyHours')->has('days', 7));
    }

    public function test_unauthorized_user_cannot_manage_access_windows(): void
    {
        $manager = User::factory()->create();
        $manager->addRole(UserRole::InventoryManager->value);

        $this->actingAs($manager)->get('/admin/access/company-hours')->assertForbidden();
        $this->actingAs($manager)->get('/admin/access/permission-windows')->assertForbidden();
    }

    public function test_super_admin_can_update_company_hours(): void
    {
        $days = collect(range(0, 6))->map(fn (int $day) => [
            'day_of_week' => $day,
            'is_open' => $day !== 5,
            'opens_at' => $day === 5 ? null : '08:00',
            'closes_at' => $day === 5 ? null : '19:00',
            'timezone' => 'Africa/Cairo',
        ])->all();

        $response = $this->actingAs($this->superAdmin())->put('/admin/access/company-hours', ['days' => $days]);

        $response->assertRedirect('/admin/access/company-hours');
        $this->assertDatabaseHas('company_working_hours', [
            'day_of_week' => 0,
            'opens_at' => '08:00:00',
            'closes_at' => '19:00:00',
        ]);
        $this->assertDatabaseHas('company_working_hours', [
            'day_of_week' => 5,
            'is_open' => false,
        ]);
    }

    public function test_super_admin_can_create_a_permission_window(): void
    {
        $response = $this->actingAs($this->superAdmin())->post('/admin/access/permission-windows', [
            'permission_name' => PermissionName::StockMove->value,
            'action' => 'stock.move',
            'day_of_week' => 6,
            'starts_at' => '09:00',
            'ends_at' => '17:00',
            'is_active' => true,
            'bypass_for_super_admin' => true,
        ]);

        $response->assertRedirect('/admin/access/permission-windows');
        $this->assertDatabaseHas('permission_access_windows', [
            'permission_name' => PermissionName::StockMove->value,
            'day_of_week' => 6,
            'starts_at' => '09:00:00',
            'ends_at' => '17:00:00',
        ]);
    }

    public function test_invalid_time_data_fails_validation(): void
    {
        $response = $this->actingAs($this->superAdmin())->post('/admin/access/permission-windows', [
            'permission_name' => PermissionName::StockMove->value,
            'day_of_week' => 6,
            'starts_at' => 'not-a-time',
            'ends_at' => '17:00',
        ]);

        $response->assertSessionHasErrors('starts_at');
        $this->assertDatabaseCount('permission_access_windows', 0);
    }

    public function test_super_admin_can_toggle_and_delete_a_permission_window(): void
    {
        $window = PermissionAccessWindow::query()->create([
            'permission_name' => PermissionName::StockMove->value,
            'action' => 'stock.move',
            'role_id' => null,
            'day_of_week' => 6,
            'starts_at' => '09:00:00',
            'ends_at' => '17:00:00',
            'timezone' => 'Africa/Cairo',
            'is_active' => true,
            'bypass_for_super_admin' => true,
        ]);

        $admin = $this->superAdmin();

        $this->actingAs($admin)->put("/admin/access/permission-windows/{$window->id}", [
            'day_of_week' => 6,
            'starts_at' => '09:00',
            'ends_at' => '17:00',
            'is_active' => false,
        ])->assertRedirect('/admin/access/permission-windows');

        $this->assertDatabaseHas('permission_access_windows', ['id' => $window->id, 'is_active' => false]);

        $this->actingAs($admin)->delete("/admin/access/permission-windows/{$window->id}")
            ->assertRedirect('/admin/access/permission-windows');

        $this->assertDatabaseMissing('permission_access_windows', ['id' => $window->id]);
    }
}
