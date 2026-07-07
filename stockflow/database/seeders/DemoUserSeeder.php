<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Creates a demo SuperAdmin account for local development/manual testing.
 * Requires RolePermissionSeeder to have run first.
 */
class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::query()->firstOrCreate(
            ['email' => 'admin@stockflow.test'],
            [
                'name' => 'StockFlow Admin',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        if (! $superAdmin->hasRole(UserRole::SuperAdmin->value)) {
            $superAdmin->addRole(UserRole::SuperAdmin->value);
        }
    }
}
