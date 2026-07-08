<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Enums\PurchaseOrderStatus;
use App\Models\BusinessAccount;
use App\Models\User;
use App\Repositories\Contracts\AuditLogRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use Illuminate\Support\Facades\Cache;

/**
 * Dashboard KPIs (requirement #1: "props must be efficient and cached
 * where useful"). Every KPI is a single COUNT/SUM query (see the
 * Repository methods this calls — no N+1, no loading full rows just to
 * count them), and the whole bundle is cached for a short TTL rather than
 * invalidated on every write: a dashboard reads as "accurate to the last
 * minute", not "live to the millisecond", which is a reasonable trade for
 * how cheap the queries already are and how often the underlying data
 * changes (stock movements, orders, payments — all the time). Contrast
 * with CatalogService's tag-based cache-and-flush-on-write, which is
 * appropriate there because catalog reads vastly outnumber writes; here
 * it's the opposite.
 */
class DashboardService
{
    private const CACHE_TTL_SECONDS = 60;

    /** Same interpretive default as ReportService::lowStock(). */
    private const LOW_STOCK_THRESHOLD = 10;

    private const RECENT_ACTIVITY_LIMIT = 5;

    public function __construct(
        private readonly StockRepositoryInterface $stock,
        private readonly OrderRepositoryInterface $orders,
        private readonly PurchaseOrderRepositoryInterface $purchaseOrders,
        private readonly PaymentRepositoryInterface $payments,
        private readonly AuditLogRepositoryInterface $auditLogs,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function kpisFor(User $user): array
    {
        $businessAccount = $user->businessAccount;

        if ($businessAccount !== null) {
            return Cache::remember(
                $this->cacheKey($businessAccount),
                self::CACHE_TTL_SECONDS,
                fn () => $this->businessBuyerKpis($businessAccount)
            );
        }

        // A bare Retail Customer (no business account, no staff
        // permissions) has no aggregate KPIs to see — staffKpis() exposes
        // store-wide numbers that aren't theirs to look at.
        if (! $this->hasAnyStaffPermission($user)) {
            return ['scope' => 'none'];
        }

        return Cache::remember('dashboard:kpis:staff', self::CACHE_TTL_SECONDS, fn () => $this->staffKpis());
    }

    private function hasAnyStaffPermission(User $user): bool
    {
        return $user->isAbleTo('stock.read')
            || $user->isAbleTo('audit.read')
            || $user->isAbleTo('po.approve')
            || $user->isAbleTo('payment.settle');
    }

    /**
     * @return array<string, mixed>
     */
    private function staffKpis(): array
    {
        return [
            'scope' => 'staff',
            'low_stock_count' => $this->stock->countLowStockLevels(self::LOW_STOCK_THRESHOLD),
            'pending_po_approvals' => $this->purchaseOrders->countByStatus(PurchaseOrderStatus::PendingApproval),
            'pending_payments' => $this->payments->countByStatus(PaymentStatus::Pending),
            'todays_sales_total' => $this->orders->salesTotalSince(now()->startOfDay()),
            'recent_activity' => $this->auditLogs->recent(self::RECENT_ACTIVITY_LIMIT)->map(fn ($log) => [
                'id' => $log->id,
                'event' => $log->event,
                'causer' => $log->causer?->name,
                'created_at' => $log->created_at,
            ]),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function businessBuyerKpis(BusinessAccount $businessAccount): array
    {
        return [
            'scope' => 'business_buyer',
            'pending_po_approvals' => $this->purchaseOrders->countByStatus(PurchaseOrderStatus::PendingApproval, $businessAccount->id),
            'credit_limit' => $businessAccount->credit_limit,
            'outstanding_balance' => $businessAccount->outstanding_balance,
        ];
    }

    private function cacheKey(BusinessAccount $businessAccount): string
    {
        return "dashboard:kpis:business_account:{$businessAccount->id}";
    }
}
