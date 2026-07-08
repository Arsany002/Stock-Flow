<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Regression test for a real bug: `migrate:fresh` resets bigint
 * auto-increment IDs but never touches Redis, so a stale Laratrust
 * permission-cache entry from a *previous* user that held the same
 * numeric ID (e.g. "user #1 has no roles") survives the reset and gets
 * served to the newly-seeded SuperAdmin, making them look unauthorized
 * everywhere. Fixed by `DatabaseSeeder::run()` flushing the cache before
 * seeding — see docs/technical/cache.md.
 */
class SeededSuperAdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_super_admin_can_access_admin_pages_even_with_a_poisoned_permission_cache(): void
    {
        // Poison the cache for user ID 1 *before* seeding runs — exactly
        // what happens when a previous migrate:fresh cycle cached "no
        // roles" for whichever user happened to hold ID 1 back then.
        $ghost = new User(['id' => 1]);
        $ghost->exists = true;
        $ghost->hasRole('super-admin');

        $this->seed(DatabaseSeeder::class);

        $admin = User::where('email', 'admin@stockflow.test')->firstOrFail();
        $this->assertSame(1, $admin->id);
        $this->assertTrue($admin->hasRole('super-admin'));

        $this->actingAs($admin)->get('/admin/users')->assertOk();
        $this->actingAs($admin)->get('/admin/roles')->assertOk();
    }
}
