<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Enums\UserRole;
use App\Models\Product;
use App\Models\User;

/**
 * Record-level authorization for products. `product.manage` (route
 * middleware) is the coarse gate; a Vendor holding that permission is
 * further restricted here to only their own products (Enterprise PRD §3,
 * "own" cell). See docs/project/canonical-decisions.md §2.
 */
class ProductPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAbleTo(PermissionName::CatalogRead->value);
    }

    public function view(User $user, Product $product): bool
    {
        return $user->isAbleTo(PermissionName::CatalogRead->value);
    }

    public function create(User $user): bool
    {
        return $user->isAbleTo(PermissionName::ProductManage->value);
    }

    public function update(User $user, Product $product): bool
    {
        if (! $user->isAbleTo(PermissionName::ProductManage->value)) {
            return false;
        }

        if (! $user->hasRole(UserRole::VendorSupplier->value)) {
            return true;
        }

        return $product->supplier !== null && $product->supplier->user_id === $user->id;
    }

    public function delete(User $user, Product $product): bool
    {
        return $this->update($user, $product);
    }
}
