<?php

namespace App\Payments;

use App\Enums\PaymentStatus;
use App\Models\Payment;

/**
 * Placeholder — no real Fawry integration yet (no reference-code
 * generation, no webhook verification). Leaves the payment `pending` for
 * manual settlement rather than throwing; see PaymobGateway's docblock for
 * the same rationale and PaymentService::verifyWebhook() for the future
 * integration point.
 */
class FawryGateway implements PaymentGatewayInterface
{
    public function initiate(Payment $payment, array $options = []): array
    {
        return [
            'status' => PaymentStatus::Pending,
            'meta' => ['note' => 'Fawry integration not implemented yet — pending manual settlement.'],
        ];
    }
}
