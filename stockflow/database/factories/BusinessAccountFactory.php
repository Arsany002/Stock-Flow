<?php

namespace Database\Factories;

use App\Models\BusinessAccount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BusinessAccount>
 */
class BusinessAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'company_name' => fake()->company(),
            'tax_id' => fake()->numerify('TAX-########'),
            'credit_limit' => fake()->randomFloat(2, 1000, 50000),
            'net_terms_days' => fake()->randomElement([0, 15, 30, 60]),
            'outstanding_balance' => 0,
            'is_active' => true,
        ];
    }
}
