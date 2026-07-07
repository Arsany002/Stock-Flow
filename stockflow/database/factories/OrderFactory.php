<?php

namespace Database\Factories;

use App\Enums\OrderChannel;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 10, 1000);
        // Flat 14% VAT — see docs/project/canonical-decisions.md §1.
        $tax = round($subtotal * 0.14, 2);

        return [
            'user_id' => User::factory(),
            'channel' => OrderChannel::B2C,
            'status' => OrderStatus::Pending,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => round($subtotal + $tax, 2),
            'reserved_until' => null,
        ];
    }
}
