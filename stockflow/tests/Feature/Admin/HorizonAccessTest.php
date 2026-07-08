<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

/**
 * Horizon exposes queue payloads and failure details with no equivalent
 * permission in the PRD's matrix, so HorizonServiceProvider::gate()
 * restricts it to SuperAdmin directly rather than a granular permission.
 */
class HorizonAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_super_admin_can_view_horizon(): void
    {
        $admin = User::factory()->create();
        $admin->addRole(UserRole::SuperAdmin->value);

        $this->assertTrue(Gate::forUser($admin)->allows('viewHorizon'));
    }

    public function test_non_super_admin_cannot_view_horizon(): void
    {
        $manager = User::factory()->create();
        $manager->addRole(UserRole::InventoryManager->value);

        $this->assertFalse(Gate::forUser($manager)->allows('viewHorizon'));
    }

    public function test_guest_cannot_view_horizon(): void
    {
        $this->assertFalse(Gate::forUser(null)->allows('viewHorizon'));
    }
}
