<?php

namespace App\Payments;

use App\Enums\PaymentStatus;
use App\Models\Payment;

/**
 * Cash on delivery — no payment actually happens at checkout time. Stays
 * `pending` until a staff member settles it (PaymentService::settleManually(),
 * `payment.settle` permission) once the cash is collected on delivery. See
 * requirement #5/#8 of the B2C checkout module: reservation stays intact
 * until that delivery/settlement confirmation.
 */
class CodGateway implements PaymentGatewayInterface
{
    public function initiate(Payment $payment, array $options = []): array
    {
        return [
            'status' => PaymentStatus::Pending,
            'meta' => ['note' => 'Cash on delivery — settle manually once cash is collected.'],
        ];
    }
}
