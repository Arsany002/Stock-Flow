<?php

namespace App\Payments;

use App\Enums\PaymentStatus;
use App\Models\Payment;

/**
 * Placeholder — no real Paymob integration yet (no API call, no redirect
 * URL, no webhook verification). Leaves the payment `pending` for manual
 * settlement rather than throwing, so checkout doesn't hard-fail when a
 * customer picks it; the Sales/Payments/Show page explains it's a
 * placeholder. Real integration (initiate iframe/intention, verify HMAC
 * webhook under /webhooks/v1/paymob) is future work — see
 * PaymentService::verifyWebhook().
 */
class PaymobGateway implements PaymentGatewayInterface
{
    public function initiate(Payment $payment, array $options = []): array
    {
        return [
            'status' => PaymentStatus::Pending,
            'meta' => ['note' => 'Paymob integration not implemented yet — pending manual settlement.'],
        ];
    }
}
