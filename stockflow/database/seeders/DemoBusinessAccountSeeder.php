<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\BusinessAccount;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Demo Business Buyer user + linked business_accounts row.
 * Requires RolePermissionSeeder to have run first (for the role to exist).
 */
class DemoBusinessAccountSeeder extends Seeder
{
    public function run(): void
    {
        $buyer = User::query()->firstOrCreate(
            ['email' => 'buyer@stockflow.test'],
            ['name' => 'Demo Business Buyer', 'password' => 'password', 'email_verified_at' => now()]
        );

        if (! $buyer->hasRole(UserRole::BusinessBuyer->value)) {
            $buyer->addRole(UserRole::BusinessBuyer->value);
        }

        BusinessAccount::query()->firstOrCreate(
            ['user_id' => $buyer->id],
            [
                'company_name' => 'Demo Trading LLC',
                'tax_id' => 'TAX-00000001',
                'credit_limit' => 100000,
                'net_terms_days' => 30,
                'outstanding_balance' => 0,
                'is_active' => true,
            ]
        );
    }
}
