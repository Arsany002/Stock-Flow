<?php

namespace Tests\Concerns;

use App\Enums\UserRole;
use App\Models\BusinessAccount;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Warehouse;
use App\Services\StockService;

/**
 * Shared fixtures for the B2B procurement module's tests.
 */
trait SetsUpProcurementFixtures
{
    /**
     * @return array{0: User, 1: BusinessAccount}
     */
    private function businessBuyer(string $creditLimit = '100000.00', string $outstandingBalance = '0.00'): array
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::BusinessBuyer->value);

        $account = BusinessAccount::factory()->create([
            'user_id' => $user->id,
            'credit_limit' => $creditLimit,
            'outstanding_balance' => $outstandingBalance,
        ]);

        return [$user, $account];
    }

    private function inventoryManager(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);

        return $user;
    }

    private function salesCashier(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::SalesCashier->value);

        return $user;
    }

    /**
     * @return array{0: User, 1: Supplier}
     */
    private function vendor(): array
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::VendorSupplier->value);
        $supplier = Supplier::factory()->create(['user_id' => $user->id]);

        return [$user, $supplier];
    }

    /**
     * @return array{product: Product, warehouse: Warehouse}
     */
    private function productWithStock(?Supplier $supplier = null, int $quantity = 10): array
    {
        $product = Product::factory()->create([
            'supplier_id' => $supplier?->id ?? Supplier::factory(),
        ]);
        $warehouse = Warehouse::factory()->create();

        if ($quantity > 0) {
            app(StockService::class)->purchaseIn($product, $warehouse, $quantity, null, null);
        }

        return ['product' => $product, 'warehouse' => $warehouse];
    }
}
