<?php

namespace App\Services;

use App\Repositories\Contracts\PurchaseOrderRepositoryInterface;

/**
 * Skeleton only — PO creation-from-quote, approval (with credit check +
 * stock reservation), rejection, and net-terms settlement (Epic 6,
 * pending_approval → approved/rejected → fulfilled → closed) is implemented
 * in the B2B procurement module.
 */
class PurchaseOrderService
{
    public function __construct(
        private readonly PurchaseOrderRepositoryInterface $purchaseOrders,
        private readonly StockService $stock,
    ) {}

    public function createFromQuote(string $quoteId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function approve(string $purchaseOrderId, int $approverId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function reject(string $purchaseOrderId, int $approverId, ?string $note = null): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function settle(string $purchaseOrderId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }
}
