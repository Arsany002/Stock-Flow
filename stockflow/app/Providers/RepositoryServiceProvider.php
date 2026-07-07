<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ImportRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\PriceListRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use App\Repositories\Contracts\QuoteRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\Contracts\SupplierRepositoryInterface;
use App\Repositories\ImportRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\PriceListRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PurchaseOrderRepository;
use App\Repositories\QuoteRepository;
use App\Repositories\StockRepository;
use App\Repositories\SupplierRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Binds each repository contract to its Eloquent implementation, so
 * Services can depend on the interface (see
 * docs/project/canonical-decisions.md §2 — Controller → Service →
 * Repository → Model).
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        ProductRepositoryInterface::class => ProductRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        SupplierRepositoryInterface::class => SupplierRepository::class,
        PriceListRepositoryInterface::class => PriceListRepository::class,
        StockRepositoryInterface::class => StockRepository::class,
        OrderRepositoryInterface::class => OrderRepository::class,
        QuoteRepositoryInterface::class => QuoteRepository::class,
        PurchaseOrderRepositoryInterface::class => PurchaseOrderRepository::class,
        PaymentRepositoryInterface::class => PaymentRepository::class,
        ImportRepositoryInterface::class => ImportRepository::class,
    ];
}
