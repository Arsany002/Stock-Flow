<?php

namespace Database\Factories;

use App\Enums\QuoteStatus;
use App\Models\BusinessAccount;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 100, 10000);
        $tax = round($subtotal * 0.14, 2);

        return [
            'business_account_id' => BusinessAccount::factory(),
            'status' => QuoteStatus::Draft,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => round($subtotal + $tax, 2),
            'expires_at' => now()->addDays(14)->toDateString(),
        ];
    }
}
