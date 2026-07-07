<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PurchaseOrder;
use App\Models\User;

/**
 * Record-level authorization for payments — covers both payable types:
 * `Order` (B2C checkout) and `PurchaseOrder` (B2B Bank Transfer
 * settlement). Same shape either way: the owner sees their own, staff
 * holding `payment.settle` sees/settles any.
 */
class PaymentPolicy
{
    public function view(User $user, Payment $payment): bool
    {
        if ($payment->payable instanceof Order) {
            return $payment->payable->user_id === $user->id || $user->isAbleTo(PermissionName::PaymentSettle->value);
        }

        if ($payment->payable instanceof PurchaseOrder) {
            $ownsAccount = $payment->payable->businessAccount !== null
                && $payment->payable->businessAccount->user_id === $user->id;

            return $ownsAccount || $user->isAbleTo(PermissionName::PaymentSettle->value);
        }

        return false;
    }

    public function settle(User $user, Payment $payment): bool
    {
        return $user->isAbleTo(PermissionName::PaymentSettle->value);
    }
}
