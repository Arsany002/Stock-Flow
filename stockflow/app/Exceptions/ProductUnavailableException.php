<?php

namespace App\Exceptions;

/**
 * Thrown when a public storefront action (add to cart) targets a product
 * that doesn't exist or is inactive. Distinct from OutOfStockException:
 * this is a catalog-visibility failure, not a stock-quantity failure — an
 * inactive product might have plenty of stock, it's just not for sale.
 */
class ProductUnavailableException extends DomainException
{
    public static function forProduct(string $productId): self
    {
        return new self(
            "Product [{$productId}] is not available for purchase.",
            ['product_id' => $productId]
        );
    }
}
