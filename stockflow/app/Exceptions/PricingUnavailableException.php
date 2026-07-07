<?php

namespace App\Exceptions;

/**
 * Thrown when a checkout line has no applicable price — no active
 * `b2c_retail` price list item covers the product/quantity. A pricing gap
 * is a catalog-data problem, not a stock problem, so it's kept distinct
 * from OutOfStockException even though both abort checkout the same way.
 */
class PricingUnavailableException extends DomainException
{
    public static function forProduct(string $productId): self
    {
        return new self(
            "No active retail price is configured for product [{$productId}].",
            ['product_id' => $productId]
        );
    }
}
