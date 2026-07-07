<?php

namespace Database\Factories;

use App\Enums\PurchaseOrderStatus;
use App\Models\BusinessAccount;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
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
            'quote_id' => null,
            'business_account_id' => BusinessAccount::factory(),
            'status' => PurchaseOrderStatus::PendingApproval,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => round($subtotal + $tax, 2),
            'due_date' => null,
        ];
    }
}
