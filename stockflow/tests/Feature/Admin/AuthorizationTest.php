<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\User;
use App\Services\RoleAssignmentService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_super_admin_can_view_permission_matrix(): void
    {
        $admin = User::factory()->create();
        $admin->addRole(UserRole::SuperAdmin->value);

        $response = $this->actingAs($admin)->get('/admin/permissions/matrix');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Admin/Permissions/Matrix')
            ->has('roles', 6)
            ->has('permissions', 18)
        );
    }

    public function test_retail_customer_cannot_view_admin_pages(): void
    {
        $retailCustomer = User::factory()->create();
        $retailCustomer->addRole(UserRole::RetailCustomer->value);

        $this->actingAs($retailCustomer)->get('/admin/users')->assertForbidden();
        $this->actingAs($retailCustomer)->get('/admin/roles')->assertForbidden();
        $this->actingAs($retailCustomer)->get('/admin/permissions/matrix')->assertForbidden();
    }

    public function test_assigning_and_removing_role_updates_permissions(): void
    {
        $admin = User::factory()->create();
        $admin->addRole(UserRole::SuperAdmin->value);

        $target = User::factory()->create();
        $this->assertFalse($target->isAbleTo('stock.move'));

        $this->actingAs($admin)->put("/admin/users/{$target->id}/roles", [
            'roles' => [UserRole::InventoryManager->value],
        ])->assertRedirect();

        $target->refresh();
        $this->assertTrue($target->isAbleTo('stock.move'));
        $this->assertTrue($target->isAbleTo('stock.transfer'));

        $this->actingAs($admin)->put("/admin/users/{$target->id}/roles", [
            'roles' => [],
        ])->assertRedirect();

        $target->refresh();
        $this->assertFalse($target->isAbleTo('stock.move'));
    }

    public function test_permission_cache_flushes_after_role_change(): void
    {
        $user = User::factory()->create();
        $rolesCacheKey = "laratrust_roles_for_users_{$user->id}";

        // First check populates the cache with "no roles".
        $this->assertFalse($user->isAbleTo('stock.move'));
        $this->assertTrue(Cache::has($rolesCacheKey));

        app(RoleAssignmentService::class)->syncRoles($user, [UserRole::InventoryManager->value]);

        // The mutation must have flushed the stale cache entry immediately.
        $this->assertFalse(Cache::has($rolesCacheKey));

        // Re-checking now reflects the new role, proving no stale cache was served.
        $user = $user->fresh();
        $this->assertTrue($user->isAbleTo('stock.move'));
        $this->assertTrue(Cache::has($rolesCacheKey));
    }
}
