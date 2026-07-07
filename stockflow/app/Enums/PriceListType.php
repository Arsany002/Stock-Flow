<?php

namespace App\Enums;

/**
 * price_lists.type — retail (B2C) vs. tiered (B2B) pricing.
 */
enum PriceListType: string
{
    case B2cRetail = 'b2c_retail';
    case B2bTier = 'b2b_tier';

    public function label(): string
    {
        return match ($this) {
            self::B2cRetail => 'B2C retail',
            self::B2bTier => 'B2B tier',
        };
    }
}
