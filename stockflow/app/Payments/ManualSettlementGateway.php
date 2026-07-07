<?php

namespace App\Payments;

use App\Enums\PaymentStatus;
use App\Models\Payment;

/**
 * Bank transfer — not part of this task's checkout flow (COD / Fake /
 * Paymob / Fawry are), but PaymentService::resolveGateway() must still
 * exhaustively cover every PaymentMethod case. Same shape as CodGateway:
 * stays `pending` until a staff member verifies the transfer and settles
 * it manually.
 */
class ManualSettlementGateway implements PaymentGatewayInterface
{
    public function initiate(Payment $payment, array $options = []): array
    {
        return [
            'status' => PaymentStatus::Pending,
            'meta' => ['note' => 'Awaiting manual settlement.'],
        ];
    }
}
