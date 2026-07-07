<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\PriceList;
use App\Models\PriceListItem;
use App\Models\User;

/**
 * Record-level authorization for price lists and their items.
 * `pricelist.manage` (route middleware) is the coarse gate. A Vendor
 * holding that permission may only manage items on their own products
 * (Enterprise PRD §3, "own" cell) — they never manage whole price lists.
 * See docs/project/canonical-decisions.md §2.
 *
 * Registered for both PriceList and PriceListItem in AppServiceProvider,
 * since one policy class serves both models here.
 */
class PriceListPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAbleTo(PermissionName::CatalogRead->value);
    }

    public function view(User $user, PriceList $priceList): bool
    {
        return $user->isAbleTo(PermissionName::CatalogRead->value);
    }

    public function create(User $user): bool
    {
        return $user->isAbleTo(PermissionName::PricelistManage->value)
            && ! $user->hasRole(UserRole::VendorSupplier->value);
    }

    public function update(User $user, PriceList $priceList): bool
    {
        return $this->create($user);
    }

    public function updateItem(User $user, PriceListItem $item): bool
    {
        if (! $user->isAbleTo(PermissionName::PricelistManage->value)) {
            return false;
        }

        if (! $user->hasRole(UserRole::VendorSupplier->value)) {
            return true;
        }

        $product = $item->product;

        return $product !== null && $product->supplier !== null && $product->supplier->user_id === $user->id;
    }

    public function deleteItem(User $user, PriceListItem $item): bool
    {
        return $this->updateItem($user, $item);
    }
}
