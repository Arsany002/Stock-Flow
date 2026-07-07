<?php

namespace App\Enums;

/**
 * orders.status — B2C order state machine:
 * pending → reserved → confirmed → fulfilled; reserved → cancelled.
 */
enum OrderStatus: string
{
    case Pending = 'pending';
    case Reserved = 'reserved';
    case Confirmed = 'confirmed';
    case Cancelled = 'cancelled';
    case Fulfilled = 'fulfilled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Reserved => 'Reserved',
            self::Confirmed => 'Confirmed',
            self::Cancelled => 'Cancelled',
            self::Fulfilled => 'Fulfilled',
        };
    }
}
