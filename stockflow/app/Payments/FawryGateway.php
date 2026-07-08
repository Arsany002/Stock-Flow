<?php

namespace App\Payments;

use App\Exceptions\PaymentVerificationException;
use App\Models\Payment;

/**
 * Placeholder — no real Fawry reference-code API call is made yet. Initiation
 * leaves the payment pending, while webhook handling rejects unsigned
 * callbacks.
 *
 * TODO: Replace the generic HMAC check and payload mapping with Fawry's
 * current production contract before real credentials are configured.
 */
class FawryGateway implements PaymentGateway
{
    public function initiate(Payment $payment, array $options = []): array
    {
        return [
            'meta' => [
                'note' => 'Fawry integration not implemented yet - pending signed callback or manual settlement.',
                'todo' => 'Create Fawry reference code and store provider references when credentials are configured.',
            ],
        ];
    }

    public function verifyWebhook(array $payload, array $headers = []): array
    {
        $this->verifyPlaceholderSignature($headers);

        $gatewayRef = $payload['referenceNumber'] ?? $payload['fawryRefNumber'] ?? $payload['transaction_id'] ?? null;
        $paymentId = $payload['merchantRefNumber'] ?? $payload['payment_id'] ?? null;
        $status = strtoupper((string) ($payload['orderStatus'] ?? $payload['status'] ?? ''));

        if (! is_string($gatewayRef) && ! is_numeric($gatewayRef)) {
            throw new PaymentVerificationException('Fawry webhook is missing a reference number.');
        }

        return [
            'payment_id' => is_string($paymentId) ? $paymentId : null,
            'gateway_ref' => 'fawry:'.(string) $gatewayRef,
            'successful' => in_array($status, ['PAID', 'PAID_SUCCESS', 'SUCCESS'], true),
            'meta' => [
                'provider' => 'fawry',
                'payload' => $payload,
            ],
        ];
    }

    /**
     * Temporary safety check. Fawry's real signature canonicalization is
     * provider-specific; this placeholder uses HMAC-SHA256(raw_body,
     * FAWRY_WEBHOOK_SECRET) so unsigned callbacks cannot change state.
     *
     * @param  array<string, mixed>  $headers
     */
    private function verifyPlaceholderSignature(array $headers): void
    {
        $secret = env('FAWRY_WEBHOOK_SECRET');
        $signature = $headers['x-fawry-signature'] ?? $headers['X-Fawry-Signature'] ?? null;
        $rawBody = $headers['raw_body'] ?? '';

        if (! is_string($secret) || $secret === '' || ! is_string($signature) || $signature === '') {
            throw PaymentVerificationException::invalidSignature('fawry');
        }

        if (! hash_equals(hash_hmac('sha256', (string) $rawBody, $secret), $signature)) {
            throw PaymentVerificationException::invalidSignature('fawry');
        }
    }
}
