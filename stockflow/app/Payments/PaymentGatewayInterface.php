<?php

namespace App\Payments;

use App\Enums\PaymentStatus;
use App\Models\Payment;

/**
 * One driver per PaymentMethod (see PaymentService::resolveGateway()).
 * Drivers never touch the database themselves — PaymentService persists
 * whatever `initiate()` returns onto the Payment row. This keeps every
 * driver a pure, easily-testable function of (Payment, options) ->
 * outcome.
 */
interface PaymentGatewayInterface
{
    /**
     * @param  array<string, mixed>  $options
     * @return array{status: PaymentStatus, meta: array<string, mixed>}
     */
    public function initiate(Payment $payment, array $options = []): array;
}
