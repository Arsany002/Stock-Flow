<?php

namespace App\Enums;

/**
 * The six roles from the Enterprise PRD §3 (Actors, Roles & Permission Matrix).
 * Values are the Laratrust `roles.name` slugs.
 */
enum UserRole: string
{
    case SuperAdmin = 'super-admin';
    case InventoryManager = 'inventory-manager';
    case SalesCashier = 'sales-cashier';
    case VendorSupplier = 'vendor-supplier';
    case BusinessBuyer = 'business-buyer';
    case RetailCustomer = 'retail-customer';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::InventoryManager => 'Inventory Manager',
            self::SalesCashier => 'Sales / Cashier',
            self::VendorSupplier => 'Vendor / Supplier',
            self::BusinessBuyer => 'Business Buyer',
            self::RetailCustomer => 'Retail Customer',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Full control: users, roles, config, all warehouses.',
            self::InventoryManager => 'Stock, warehouses, movements, imports; PO approval. Warehouse-team scoped.',
            self::SalesCashier => 'Creates B2C sales orders, processes payments.',
            self::VendorSupplier => 'Supplies products; manages own price list.',
            self::BusinessBuyer => 'Requests quotes, issues POs, buys on credit terms.',
            self::RetailCustomer => 'Browses catalog, checks out, pays.',
        };
    }
}
