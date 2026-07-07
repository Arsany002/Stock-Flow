<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\StockLevel;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockLevel>
 */
class StockLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $onHand = fake()->numberBetween(0, 500);

        return [
            'product_id' => Product::factory(),
            'warehouse_id' => Warehouse::factory(),
            'on_hand' => $onHand,
            'reserved' => fake()->numberBetween(0, $onHand),
        ];
    }
}
