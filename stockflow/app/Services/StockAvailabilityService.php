<?php

namespace App\Services;

use App\Repositories\Contracts\StockRepositoryInterface;

/**
 * Translates raw stock numbers into the public-safe vocabulary the
 * storefront is allowed to show a guest: a status/label, never an exact
 * quantity (see docs/project/canonical-decisions.md and the storefront
 * requirement "do not expose exact stock quantity to guests"). Reads are
 * deliberately live/uncached — see StockRepositoryInterface::
 * availabilityForProduct()'s docblock.
 */
class StockAvailabilityService
{
    public const STATUS_IN_STOCK = 'in_stock';

    public const STATUS_LOW_STOCK = 'low_stock';

    public const STATUS_OUT_OF_STOCK = 'out_of_stock';

    /**
     * Matches ReportService::DEFAULT_LOW_STOCK_THRESHOLD so the public
     * "Low Stock" badge and the staff Low Stock report agree on what
     * "low" means.
     */
    private const LOW_STOCK_THRESHOLD = 10;

    public function __construct(private readonly StockRepositoryInterface $stock) {}

    public function totalAvailableFor(string $productId): int
    {
        return $this->stock->availabilityForProduct($productId);
    }

    /**
     * @param  list<string>  $productIds
     * @return array<string, int>
     */
    public function totalAvailableForMany(array $productIds): array
    {
        return $this->stock->availabilityForProducts($productIds);
    }

    public function statusFor(int $available): string
    {
        return match (true) {
            $available <= 0 => self::STATUS_OUT_OF_STOCK,
            $available <= self::LOW_STOCK_THRESHOLD => self::STATUS_LOW_STOCK,
            default => self::STATUS_IN_STOCK,
        };
    }

    public function labelFor(string $status): string
    {
        return match ($status) {
            self::STATUS_OUT_OF_STOCK => 'Out of Stock',
            self::STATUS_LOW_STOCK => 'Low Stock',
            default => 'In Stock',
        };
    }
}
