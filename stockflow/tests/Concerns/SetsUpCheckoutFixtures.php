<?php

namespace Tests\Concerns;

use App\Enums\PriceListType;
use App\Enums\UserRole;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;

/**
 * Shared fixtures for the B2C checkout module's tests: a priced,
 * in-stock product and the roles that can buy/settle it.
 */
trait SetsUpCheckoutFixtures
{
    private function retailCustomer(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::RetailCustomer->value);

        return $user;
    }

    private function salesCashier(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::SalesCashier->value);

        return $user;
    }

    /**
     * @return array{product: Product, warehouse: Warehouse}
     */
    private function productWithRetailStock(int $quantity = 10, string $price = '100.00'): array
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();

        $priceList = PriceList::factory()->create([
            'type' => PriceListType::B2cRetail,
            'is_active' => true,
        ]);

        PriceListItem::factory()->create([
            'price_list_id' => $priceList->id,
            'product_id' => $product->id,
            'unit_price' => $price,
            'min_qty' => 1,
        ]);

        if ($quantity > 0) {
            app(StockService::class)->purchaseIn($product, $warehouse, $quantity, null, null);
        }

        return ['product' => $product, 'warehouse' => $warehouse];
    }
}
