<?php

namespace App\Policies;

use App\Enums\PermissionName;
use App\Models\Order;
use App\Models\User;

/**
 * Record-level authorization for B2C orders: a customer may only see their
 * own orders; staff holding `payment.settle` (SalesCashier, InventoryManager,
 * SuperAdmin — see RolePermissionSeeder) can see and settle any order, since
 * they're the ones confirming COD deliveries / placeholder-gateway
 * payments. `sale.create` (route middleware) is the coarse gate for
 * checking out at all.
 */
class OrderPolicy
{
    public function view(User $user, Order $order): bool
    {
        return $order->user_id === $user->id || $user->isAbleTo(PermissionName::PaymentSettle->value);
    }

    public function create(User $user): bool
    {
        return $user->isAbleTo(PermissionName::SaleCreate->value);
    }

    /**
     * Staff-only: settle a pending payment (Cod / Paymob / Fawry
     * placeholder) and confirm the order.
     */
    public function settlePayment(User $user, Order $order): bool
    {
        return $user->isAbleTo(PermissionName::PaymentSettle->value);
    }

    /**
     * Staff-only: mark a confirmed order as fulfilled (delivered/picked up).
     */
    public function fulfill(User $user, Order $order): bool
    {
        return $user->isAbleTo(PermissionName::PaymentSettle->value);
    }
}
