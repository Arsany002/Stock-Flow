<?php

namespace App\Enums;

/**
 * The permission catalog from the Enterprise PRD §3 permission matrix.
 * Values are the Laratrust `permissions.name` slugs.
 */
enum PermissionName: string
{
    case CatalogRead = 'catalog.read';
    case ProductManage = 'product.manage';
    case CategoryManage = 'category.manage';
    case WarehouseManage = 'warehouse.manage';
    case StockMove = 'stock.move';
    case StockTransfer = 'stock.transfer';
    case StockRead = 'stock.read';
    case ImportRun = 'import.run';
    case PricelistManage = 'pricelist.manage';
    case SaleCreate = 'sale.create';
    case QuoteRequest = 'quote.request';
    case QuotePrice = 'quote.price';
    case PoApprove = 'po.approve';
    case PaymentSettle = 'payment.settle';
    case UserManage = 'user.manage';
    case RoleManage = 'role.manage';
    case AuditRead = 'audit.read';
    case AccessManage = 'access.manage';

    public function label(): string
    {
        return match ($this) {
            self::CatalogRead => 'Read catalog',
            self::ProductManage => 'Manage products',
            self::CategoryManage => 'Manage categories',
            self::WarehouseManage => 'Manage warehouses',
            self::StockMove => 'Move stock',
            self::StockTransfer => 'Transfer stock between warehouses',
            self::StockRead => 'Read stock levels',
            self::ImportRun => 'Run Excel imports',
            self::PricelistManage => 'Manage price lists',
            self::SaleCreate => 'Create sales orders',
            self::QuoteRequest => 'Request quotes (RFQ)',
            self::QuotePrice => 'Price quotes',
            self::PoApprove => 'Approve purchase orders',
            self::PaymentSettle => 'Settle payments',
            self::UserManage => 'Manage users',
            self::RoleManage => 'Manage roles',
            self::AuditRead => 'Read audit log',
            self::AccessManage => 'Manage working hours & access windows',
        };
    }
}
