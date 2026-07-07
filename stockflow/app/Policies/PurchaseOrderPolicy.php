<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Models\PurchaseOrder;
use App\Models\User;

/**
 * Record-level authorization for B2B purchase orders. A Business Buyer
 * only ever sees their own account's POs; staff holding `po.approve` or
 * `payment.settle` can see and act on any (they need visibility to do
 * their job — approving or settling isn't scoped to "own").
 */
class PurchaseOrderPolicy
{
    public function view(User $user, PurchaseOrder $purchaseOrder): bool
    {
        if ($this->ownsAccount($user, $purchaseOrder)) {
            return true;
        }

        return $user->isAbleTo(PermissionName::PoApprove->value) || $user->isAbleTo(PermissionName::PaymentSettle->value);
    }

    public function approve(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->isAbleTo(PermissionName::PoApprove->value);
    }

    public function reject(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->isAbleTo(PermissionName::PoApprove->value);
    }

    public function settle(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $user->isAbleTo(PermissionName::PaymentSettle->value);
    }

    private function ownsAccount(User $user, PurchaseOrder $purchaseOrder): bool
    {
        return $purchaseOrder->businessAccount !== null && $purchaseOrder->businessAccount->user_id === $user->id;
    }
}
