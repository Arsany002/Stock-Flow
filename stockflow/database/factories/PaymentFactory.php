<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payable_type' => Order::class,
            'payable_id' => Order::factory(),
            'method' => fake()->randomElement(PaymentMethod::cases()),
            'status' => PaymentStatus::Pending,
            'gateway_ref' => fake()->unique()->uuid(),
            'amount' => fake()->randomFloat(2, 10, 5000),
            'meta' => null,
        ];
    }

    public function forPurchaseOrder(?PurchaseOrder $purchaseOrder = null): static
    {
        return $this->state(fn (array $attributes) => [
            'payable_type' => PurchaseOrder::class,
            'payable_id' => $purchaseOrder?->id ?? PurchaseOrder::factory(),
        ]);
    }
}
