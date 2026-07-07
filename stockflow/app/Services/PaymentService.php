<?php

namespace App\Services;

use App\Repositories\Contracts\PaymentRepositoryInterface;

/**
 * Skeleton only — gateway initiation, signature-verified/idempotent webhook
 * handling, and manual (Bank Transfer) settlement are implemented in the
 * payments module. Gateway drivers themselves live under app/Payments.
 */
class PaymentService
{
    public function __construct(private readonly PaymentRepositoryInterface $payments) {}

    public function initiate(string $payableType, string $payableId, string $method, float $amount): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function verifyWebhook(string $method, array $payload, string $signature): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function settleManually(string $paymentId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }
}
