<?php

namespace App\Payments;

use App\Models\Payment;

/**
 * Cash on delivery has no online callback. The reservation remains held until
 * a staff member confirms cash collection through the authenticated settlement
 * flow.
 */
class CodGateway implements PaymentGateway
{
    public function initiate(Payment $payment, array $options = []): array
    {
        return [
            'meta' => ['note' => 'Cash on delivery - settle manually once cash is collected.'],
        ];
    }

    public function verifyWebhook(array $payload, array $headers = []): array
    {
        throw new \LogicException('COD has no online webhook; settle it through the authenticated staff flow.');
    }
}
