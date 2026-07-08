<?php

namespace App\Enums;

/**
 * import_batches.entity — the catalogable data types the Excel importer
 * supports (FR-7.1).
 */
enum ImportEntity: string
{
    case Categories = 'categories';
    case Products = 'products';
    case Warehouses = 'warehouses';
    case Suppliers = 'suppliers';
    case PriceLists = 'price_lists';
    case OpeningStock = 'opening_stock';

    public function label(): string
    {
        return match ($this) {
            self::Categories => 'Categories',
            self::Products => 'Products',
            self::Warehouses => 'Warehouses',
            self::Suppliers => 'Suppliers',
            self::PriceLists => 'Price lists',
            self::OpeningStock => 'Opening stock',
        };
    }
}
