<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Flushes the cache first. `migrate:fresh` resets bigint auto-increment
     * IDs (users/roles/permissions all use bigint PKs — see the ERD
     * deviation note in CLAUDE.md), so a freshly-seeded user can be handed
     * the exact same numeric ID a *different* user had in a previous
     * seeding pass. Laratrust's permission cache is keyed by that ID
     * (`laratrust_roles_for_users_{id}`) — `migrate:fresh` doesn't touch
     * Redis, so a stale "this ID has no roles" entry from before the reset
     * survives and is silently served to the new user, making a
     * newly-seeded SuperAdmin look unauthorized everywhere until the cache
     * happens to expire or is cleared by hand. See docs/technical/cache.md
     * §"Known failure mode: stale Laratrust cache after migrate:fresh".
     */
    public function run(): void
    {
        Cache::flush();

        $this->call([
            RolePermissionSeeder::class,
            DemoUserSeeder::class,
            DemoWarehouseSeeder::class,
            DemoCatalogSeeder::class,
            DemoBusinessAccountSeeder::class,
            CompanyWorkingHourSeeder::class,
            PermissionAccessWindowSeeder::class,
        ]);
    }
}
