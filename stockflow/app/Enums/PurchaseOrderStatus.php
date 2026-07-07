<?php

namespace App\Enums;

/**
 * purchase_orders.status — pending_approval → approved → fulfilled → closed;
 * pending_approval → rejected.
 */
enum PurchaseOrderStatus: string
{
    case PendingApproval = 'pending_approval';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Fulfilled = 'fulfilled';
    case Closed = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::PendingApproval => 'Pending approval',
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
            self::Fulfilled => 'Fulfilled',
            self::Closed => 'Closed',
        };
    }
}
