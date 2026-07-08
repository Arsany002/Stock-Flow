<?php

namespace App\Payments;

use App\Exceptions\PaymentVerificationException;
use App\Models\Payment;
use Illuminate\Support\Str;

/**
 * Demo/test-only gateway. It still follows the production architecture:
 * initiation creates a pending payment and a later verified fake callback
 * confirms or fails it. Checkout may dispatch that callback immediately for
 * manual testing convenience.
 */
class FakeGateway implements PaymentGateway
{
    public function initiate(Payment $payment, array $options = []): array
    {
        return [
            'gateway_ref' => $this->gatewayRefFor($payment),
            'meta' => [
                'note' => 'Fake gateway: pending simulated callback.',
                'requested_outcome' => $options['outcome'] ?? null,
            ],
        ];
    }

    public function verifyWebhook(array $payload, array $headers = []): array
    {
        $paymentId = $payload['payment_id'] ?? null;
        $gatewayRef = $payload['gateway_ref'] ?? null;
        $outcome = $payload['outcome'] ?? 'succeed';

        if (! is_string($paymentId) || $paymentId === '') {
            throw new PaymentVerificationException('Fake gateway webhook is missing payment_id.');
        }

        if (! is_string($gatewayRef) || $gatewayRef === '') {
            throw new PaymentVerificationException('Fake gateway webhook is missing gateway_ref.');
        }

        if (! in_array($outcome, ['succeed', 'fail'], true)) {
            throw new PaymentVerificationException('Fake gateway webhook outcome must be succeed or fail.');
        }

        $signature = $headers['x-fake-gateway-signature'] ?? $headers['X-Fake-Gateway-Signature'] ?? null;

        if (is_string($signature) && ! hash_equals($this->signatureFor($gatewayRef, $outcome), $signature)) {
            throw PaymentVerificationException::invalidSignature('fake_gateway');
        }

        return [
            'payment_id' => $paymentId,
            'gateway_ref' => $gatewayRef,
            'successful' => $outcome === 'succeed',
            'meta' => [
                'provider' => 'fake_gateway',
                'outcome' => $outcome,
                'webhook_id' => $payload['webhook_id'] ?? (string) Str::uuid(),
            ],
        ];
    }

    public function gatewayRefFor(Payment $payment): string
    {
        return "fake_gateway:{$payment->id}";
    }

    public function signatureFor(string $gatewayRef, string $outcome): string
    {
        return hash_hmac('sha256', "{$gatewayRef}|{$outcome}", config('app.key'));
    }
}
