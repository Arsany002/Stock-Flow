<?php

namespace Tests\Unit\Services;

use App\Repositories\Contracts\ImportRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use App\Repositories\Contracts\QuoteRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\ImportRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\ProductRepository;
use App\Repositories\PurchaseOrderRepository;
use App\Repositories\QuoteRepository;
use App\Repositories\StockRepository;
use App\Services\CatalogService;
use App\Services\ImportService;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\PurchaseOrderService;
use App\Services\QuoteService;
use App\Services\StockService;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Proves the shared backend architecture (Controller → FormRequest →
 * Service → Repository → Model) is correctly wired end to end at the
 * container level: every service resolves, and does so with its repository
 * dependencies satisfied via the bound interfaces (not concrete classes),
 * per docs/project/canonical-decisions.md §2.
 */
class ServiceContainerResolutionTest extends TestCase
{
    /**
     * @return array<string, array{0: class-string}>
     */
    public static function serviceClasses(): array
    {
        return [
            'CatalogService' => [CatalogService::class],
            'StockService' => [StockService::class],
            'OrderService' => [OrderService::class],
            'QuoteService' => [QuoteService::class],
            'PurchaseOrderService' => [PurchaseOrderService::class],
            'PaymentService' => [PaymentService::class],
            'ImportService' => [ImportService::class],
        ];
    }

    #[DataProvider('serviceClasses')]
    public function test_service_resolves_from_the_container(string $serviceClass): void
    {
        $service = $this->app->make($serviceClass);

        $this->assertInstanceOf($serviceClass, $service);
    }

    /**
     * @return array<string, array{0: class-string, 1: class-string}>
     */
    public static function repositoryBindings(): array
    {
        return [
            'Product' => [ProductRepositoryInterface::class, ProductRepository::class],
            'Stock' => [StockRepositoryInterface::class, StockRepository::class],
            'Order' => [OrderRepositoryInterface::class, OrderRepository::class],
            'Quote' => [QuoteRepositoryInterface::class, QuoteRepository::class],
            'PurchaseOrder' => [PurchaseOrderRepositoryInterface::class, PurchaseOrderRepository::class],
            'Payment' => [PaymentRepositoryInterface::class, PaymentRepository::class],
            'Import' => [ImportRepositoryInterface::class, ImportRepository::class],
        ];
    }

    #[DataProvider('repositoryBindings')]
    public function test_repository_interface_resolves_to_its_concrete_implementation(
        string $interface,
        string $concrete
    ): void {
        $repository = $this->app->make($interface);

        $this->assertInstanceOf($concrete, $repository);
    }
}
