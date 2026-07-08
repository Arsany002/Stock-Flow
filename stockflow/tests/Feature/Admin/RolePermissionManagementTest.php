<?php

namespace Tests\Feature\Admin;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Module 4: role/permission management improvements — a `role.manage`
 * holder can edit a role's own permission set (not just which roles a
 * user has). Requirement #2: permission changes are audited.
 */
class RolePermissionManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::SuperAdmin->value);

        return $user;
    }

    public function test_role_manage_holder_can_update_a_roles_permissions(): void
    {
        $admin = $this->admin();
        $role = Role::query()->where('name', UserRole::SalesCashier->value)->firstOrFail();

        $response = $this->actingAs($admin)->put("/admin/roles/{$role->id}/permissions", [
            'permissions' => [PermissionName::CatalogRead->value, PermissionName::AuditRead->value],
        ]);

        $response->assertRedirect('/admin/roles');

        $role->refresh();
        $this->assertSame(
            [PermissionName::AuditRead->value, PermissionName::CatalogRead->value],
            $role->permissions()->pluck('name')->sort()->values()->all()
        );
        $this->assertTrue($role->hasPermission(PermissionName::CatalogRead->value));
        $this->assertTrue($role->hasPermission(PermissionName::AuditRead->value));
        $this->assertFalse($role->hasPermission(PermissionName::SaleCreate->value));
    }

    public function test_role_permission_change_is_audited(): void
    {
        $admin = $this->admin();
        $role = Role::query()->where('name', UserRole::SalesCashier->value)->firstOrFail();

        $this->actingAs($admin)->put("/admin/roles/{$role->id}/permissions", [
            'permissions' => [PermissionName::CatalogRead->value],
        ]);

        $this->assertDatabaseHas('activity_log', [
            'event' => 'role.permissions_updated',
            'causer_id' => $admin->id,
            'subject_type' => 'App\\Models\\Role',
            'subject_id' => (string) $role->id,
        ]);
    }

    public function test_unauthorized_user_cannot_update_role_permissions(): void
    {
        $customer = User::factory()->create();
        $customer->addRole(UserRole::RetailCustomer->value);
        $role = Role::query()->where('name', UserRole::SalesCashier->value)->firstOrFail();

        $this->actingAs($customer)->put("/admin/roles/{$role->id}/permissions", [
            'permissions' => [],
        ])->assertForbidden();
    }

    public function test_a_users_permissions_reflect_updated_role_permissions_immediately(): void
    {
        $admin = $this->admin();
        $role = Role::query()->where('name', UserRole::SalesCashier->value)->firstOrFail();
        $cashier = User::factory()->create();
        $cashier->addRole(UserRole::SalesCashier->value);

        $this->assertFalse($cashier->isAbleTo(PermissionName::AuditRead->value));

        $this->actingAs($admin)->put("/admin/roles/{$role->id}/permissions", [
            'permissions' => [PermissionName::AuditRead->value],
        ]);

        $this->assertTrue($cashier->fresh()->isAbleTo(PermissionName::AuditRead->value));
    }
}
