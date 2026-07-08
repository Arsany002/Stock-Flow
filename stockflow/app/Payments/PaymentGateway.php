<?php

namespace App\Payments;

use App\Models\Payment;

/**
 * Gateway drivers are thin adapters. They may prepare redirect/reference
 * metadata during initiation and they verify provider callbacks, but they do
 * not mutate database state. PaymentService owns persistence, idempotency, and
 * reservation -> sale_out conversion.
 */
interface PaymentGateway
{
    /**
     * @param  array<string, mixed>  $options
     * @return array{gateway_ref?: string|null, meta?: array<string, mixed>}
     */
    public function initiate(Payment $payment, array $options = []): array;

    /**
     * Verify a webhook/callback and normalize it into a provider-independent
     * event. Implementations must throw PaymentVerificationException when the
     * payload cannot be trusted.
     *
     * @param  array<string, mixed>  $payload
     * @param  array<string, mixed>  $headers
     * @return array{
     *     payment_id?: string|null,
     *     gateway_ref: string,
     *     successful: bool,
     *     meta?: array<string, mixed>
     * }
     */
    public function verifyWebhook(array $payload, array $headers = []): array;
}
