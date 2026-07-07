<?php

namespace App\Services;

use App\Repositories\Contracts\OrderRepositoryInterface;

/**
 * Skeleton only — B2C checkout/payment-confirmation/cancellation state
 * machine (Epic 5) is implemented in the B2C checkout module.
 */
class OrderService
{
    public function __construct(
        private readonly OrderRepositoryInterface $orders,
        private readonly StockService $stock,
    ) {}

    public function checkout(int $userId, array $lines): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function confirmPayment(string $orderId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function cancel(string $orderId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }
}
