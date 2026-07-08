<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

/**
 * Modules 3/4: user management + role/permission management improvements.
 * Requirement #2: user/role changes are audited.
 */
class UserRoleManagementTest extends TestCase
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

    public function test_user_manage_holder_can_view_users_index(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->get('/admin/users')->assertOk();
    }

    public function test_unauthorized_user_cannot_view_users_index(): void
    {
        $customer = User::factory()->create();
        $customer->addRole(UserRole::RetailCustomer->value);

        $this->actingAs($customer)->get('/admin/users')->assertForbidden();
    }

    public function test_edit_roles_page_renders_admin_users_edit_component(): void
    {
        $admin = $this->admin();
        $target = User::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/users/{$target->id}/roles");

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page->component('Admin/Users/Edit'));
    }

    public function test_updating_user_roles_is_audited(): void
    {
        $admin = $this->admin();
        $target = User::factory()->create();

        $this->actingAs($admin)->put("/admin/users/{$target->id}/roles", [
            'roles' => [UserRole::SalesCashier->value],
        ])->assertRedirect();

        $this->assertTrue($target->fresh()->hasRole(UserRole::SalesCashier->value));
        $this->assertDatabaseHas('activity_log', [
            'event' => 'user.roles_updated',
            'causer_id' => $admin->id,
            'subject_type' => 'App\\Models\\User',
            'subject_id' => (string) $target->id,
        ]);
    }
}
