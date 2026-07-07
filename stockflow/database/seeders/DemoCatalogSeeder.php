<?php

namespace Database\Seeders;

use App\Enums\MovementType;
use App\Enums\PriceListType;
use App\Models\Category;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\StockLevel;
use App\Models\StockMovement;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Demo categories, suppliers, products, price lists, and opening stock.
 * Requires DemoWarehouseSeeder to have run first.
 *
 * Opening stock is recorded as `purchase_in` ledger rows (not just a
 * stock_levels insert), matching FR-7.5 / docs/project/canonical-decisions.md §6:
 * stock_levels is always a projection of stock_movements, never a
 * standalone source of truth.
 */
class DemoCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::query()->firstOrCreate(
            ['slug' => 'electronics'],
            ['name' => 'Electronics']
        );

        $accessories = Category::query()->firstOrCreate(
            ['slug' => 'electronics-accessories'],
            ['name' => 'Accessories', 'parent_id' => $electronics->id]
        );

        $supplier = Supplier::query()->firstOrCreate(
            ['email' => 'contact@demo-supplier.test'],
            ['name' => 'Demo Supplier Co.', 'phone' => '+20 100 000 0000', 'is_active' => true]
        );

        $products = collect([
            ['sku' => 'SKU-LAPTOP-001', 'name' => 'StockFlow Laptop 14"', 'category_id' => $electronics->id, 'retail' => 25000, 'tier' => 22000],
            ['sku' => 'SKU-PHONE-001', 'name' => 'StockFlow Phone X', 'category_id' => $electronics->id, 'retail' => 15000, 'tier' => 13000],
            ['sku' => 'SKU-CASE-001', 'name' => 'Laptop Sleeve Case', 'category_id' => $accessories->id, 'retail' => 350, 'tier' => 250],
            ['sku' => 'SKU-CHARGER-001', 'name' => 'USB-C Fast Charger', 'category_id' => $accessories->id, 'retail' => 500, 'tier' => 400],
        ])->map(fn (array $attributes) => [
            ...$attributes,
            'product' => Product::query()->firstOrCreate(
                ['sku' => $attributes['sku']],
                [
                    'category_id' => $attributes['category_id'],
                    'supplier_id' => $supplier->id,
                    'name' => $attributes['name'],
                    'description' => "Demo product: {$attributes['name']}",
                    'is_active' => true,
                ]
            ),
        ]);

        $retailPriceList = PriceList::query()->firstOrCreate(
            ['name' => 'Retail price list'],
            ['type' => PriceListType::B2cRetail, 'is_active' => true]
        );

        $tierPriceList = PriceList::query()->firstOrCreate(
            ['name' => 'B2B tier price list'],
            ['type' => PriceListType::B2bTier, 'is_active' => true]
        );

        foreach ($products as $entry) {
            $retailPriceList->items()->firstOrCreate(
                ['product_id' => $entry['product']->id, 'min_qty' => 1],
                ['unit_price' => $entry['retail']]
            );

            $tierPriceList->items()->firstOrCreate(
                ['product_id' => $entry['product']->id, 'min_qty' => 10],
                ['unit_price' => $entry['tier']]
            );
        }

        $warehouses = Warehouse::query()->get();

        foreach ($products as $entry) {
            foreach ($warehouses as $warehouse) {
                if (StockLevel::query()
                    ->where('product_id', $entry['product']->id)
                    ->where('warehouse_id', $warehouse->id)
                    ->exists()
                ) {
                    continue;
                }

                $openingQuantity = 100;

                DB::transaction(function () use ($entry, $warehouse, $openingQuantity) {
                    StockMovement::query()->create([
                        'product_id' => $entry['product']->id,
                        'warehouse_id' => $warehouse->id,
                        'type' => MovementType::PurchaseIn,
                        'quantity' => $openingQuantity,
                        'reason' => 'Demo opening stock',
                    ]);

                    StockLevel::query()->create([
                        'product_id' => $entry['product']->id,
                        'warehouse_id' => $warehouse->id,
                        'on_hand' => $openingQuantity,
                        'reserved' => 0,
                    ]);
                });
            }
        }
    }
}
