<?php

namespace App\Enums;

/**
 * stock_movements.type — the only mutations ever applied to inventory.
 * See docs/project/canonical-decisions.md §6 (immutable, insert-only ledger).
 */
enum MovementType: string
{
    case PurchaseIn = 'purchase_in';
    case SaleOut = 'sale_out';
    case Reservation = 'reservation';
    case Release = 'release';
    case Adjustment = 'adjustment';
    case TransferIn = 'transfer_in';
    case TransferOut = 'transfer_out';

    public function label(): string
    {
        return match ($this) {
            self::PurchaseIn => 'Purchase in',
            self::SaleOut => 'Sale out',
            self::Reservation => 'Reservation',
            self::Release => 'Release',
            self::Adjustment => 'Adjustment',
            self::TransferIn => 'Transfer in',
            self::TransferOut => 'Transfer out',
        };
    }
}
