<?php

namespace App\Payments;

use App\Exceptions\PaymentVerificationException;
use App\Models\Payment;

/**
 * Placeholder — no real Paymob API call is made yet. Initiation leaves the
 * payment pending, while webhook handling rejects unsigned callbacks.
 *
 * TODO: Replace the generic HMAC check and payload mapping with Paymob's
 * current Accept/Intention contract before real credentials are configured.
 */
class PaymobGateway implements PaymentGateway
{
    public function initiate(Payment $payment, array $options = []): array
    {
        return [
            'meta' => [
                'note' => 'Paymob integration not implemented yet - pending signed webhook or manual settlement.',
                'todo' => 'Create Paymob intention/order and store provider references when credentials are configured.',
            ],
        ];
    }

    public function verifyWebhook(array $payload, array $headers = []): array
    {
        $this->verifyPlaceholderSignature($headers);

        $obj = is_array($payload['obj'] ?? null) ? $payload['obj'] : $payload;
        $gatewayRef = $obj['id'] ?? $obj['transaction_id'] ?? $payload['transaction_id'] ?? null;
        $paymentId = $obj['merchant_order_id'] ?? $payload['payment_id'] ?? null;
        $success = $obj['success'] ?? $payload['success'] ?? false;

        if (! is_string($gatewayRef) && ! is_numeric($gatewayRef)) {
            throw new PaymentVerificationException('Paymob webhook is missing a transaction id.');
        }

        return [
            'payment_id' => is_string($paymentId) ? $paymentId : null,
            'gateway_ref' => 'paymob:'.(string) $gatewayRef,
            'successful' => filter_var($success, FILTER_VALIDATE_BOOL),
            'meta' => [
                'provider' => 'paymob',
                'payload' => $payload,
            ],
        ];
    }

    /**
     * Temporary safety check. Paymob's real signature canonicalization is
     * provider-specific; this placeholder uses HMAC-SHA256(raw_body,
     * PAYMOB_WEBHOOK_SECRET) so unsigned callbacks cannot change state.
     *
     * @param  array<string, mixed>  $headers
     */
    private function verifyPlaceholderSignature(array $headers): void
    {
        $secret = env('PAYMOB_WEBHOOK_SECRET');
        $signature = $headers['x-paymob-signature'] ?? $headers['X-Paymob-Signature'] ?? null;
        $rawBody = $headers['raw_body'] ?? '';

        if (! is_string($secret) || $secret === '' || ! is_string($signature) || $signature === '') {
            throw PaymentVerificationException::invalidSignature('paymob');
        }

        if (! hash_equals(hash_hmac('sha256', (string) $rawBody, $secret), $signature)) {
            throw PaymentVerificationException::invalidSignature('paymob');
        }
    }
}
