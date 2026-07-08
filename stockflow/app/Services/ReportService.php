<?php

namespace App\Services;

use App\Repositories\Contracts\ImportRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Read-only reporting layer (modules 5–9): low stock, stock movements,
 * sales, payments, and import history. Every method is a thin
 * pass-through to a repository query that already applies the relevant
 * filters and pagination — this class exists so Controllers depend on a
 * Service, never a Repository directly, per
 * docs/project/canonical-decisions.md §2, matching every other module in
 * this codebase. No report method mutates anything.
 */
class ReportService
{
    /**
     * Default "low stock" cutoff when the caller doesn't specify one —
     * not defined at a specific unit count anywhere in the PRD, so this is
     * an interpretive default (available <= 10 units, regardless of the
     * product/warehouse's normal turnover). Callers filtering the report
     * can pass a different threshold.
     */
    private const DEFAULT_LOW_STOCK_THRESHOLD = 10;

    public function __construct(
        private readonly StockRepositoryInterface $stock,
        private readonly OrderRepositoryInterface $orders,
        private readonly PaymentRepositoryInterface $payments,
        private readonly ImportRepositoryInterface $imports,
    ) {}

    /**
     * @param  array<string, mixed>  $filters
     */
    public function lowStock(int $perPage = 15, ?int $threshold = null, array $filters = []): LengthAwarePaginator
    {
        return $this->stock->paginateLowStockLevels($threshold ?? self::DEFAULT_LOW_STOCK_THRESHOLD, $perPage, $filters);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function stockMovements(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->stock->paginateMovements($perPage, $filters);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function sales(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->orders->paginateForSalesReport($perPage, $filters);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function payments(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->payments->paginateForReport($perPage, $filters);
    }

    /**
     * @param  array<string, mixed>  $filters
     */
    public function imports(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->imports->paginateForReport($perPage, $filters);
    }
}
