<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DemoWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect([
            ['name' => 'Cairo Warehouse', 'code' => 'CAI-1', 'address' => 'Cairo, Egypt'],
            ['name' => 'Alexandria Warehouse', 'code' => 'ALX-1', 'address' => 'Alexandria, Egypt'],
        ])->each(fn (array $attributes) => Warehouse::query()->firstOrCreate(
            ['code' => $attributes['code']],
            [...$attributes, 'is_active' => true]
        ));
    }
}
