<?php

namespace App\Payments;

use App\Enums\PaymentStatus;
use App\Models\Payment;

/**
 * Demo/test-only gateway that resolves synchronously at checkout time —
 * there's no real money movement and no async webhook, so the caller
 * decides the outcome up front via $options['outcome'] ('succeed' | 'fail',
 * default 'succeed'). Lets the checkout flow and its tests exercise both
 * the payment-success (reservation -> sale_out) and payment-failure
 * (reservation -> released) paths without a real payment provider.
 */
class FakeGateway implements PaymentGatewayInterface
{
    public function initiate(Payment $payment, array $options = []): array
    {
        $outcome = $options['outcome'] ?? 'succeed';

        return match ($outcome) {
            'fail' => [
                'status' => PaymentStatus::Failed,
                'meta' => ['note' => 'Fake gateway: simulated failure.'],
            ],
            default => [
                'status' => PaymentStatus::Paid,
                'meta' => ['note' => 'Fake gateway: simulated success.'],
            ],
        };
    }
}
