<?php

namespace App\Enums;

/**
 * orders.channel — single value in v1 (B2C only; B2B goes through
 * quotes/purchase_orders instead), kept as an enum for forward-compatibility.
 */
enum OrderChannel: string
{
    case B2C = 'b2c';

    public function label(): string
    {
        return match ($this) {
            self::B2C => 'B2C',
        };
    }
}
