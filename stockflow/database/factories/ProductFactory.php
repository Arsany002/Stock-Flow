<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'supplier_id' => Supplier::factory(),
            'sku' => strtoupper(fake()->unique()->bothify('SKU-#####??')),
            'name' => ucfirst(fake()->unique()->words(3, true)),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
