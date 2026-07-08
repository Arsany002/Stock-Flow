<?php

namespace App\Payments;

use App\Models\Payment;

/**
 * Bank transfer stays pending until a staff member with payment.settle verifies
 * the transfer. If a bank reference is provided, it is stored as a unique
 * gateway_ref so the same transfer cannot be processed twice.
 */
class BankTransferGateway implements PaymentGateway
{
    public function initiate(Payment $payment, array $options = []): array
    {
        $reference = isset($options['reference']) && $options['reference'] !== ''
            ? (string) $options['reference']
            : null;

        return [
            'gateway_ref' => $reference !== null ? "bank_transfer:{$reference}" : null,
            'meta' => [
                'note' => 'Awaiting manual bank transfer settlement.',
                'reference' => $reference,
                'proof_url' => $options['proof_url'] ?? null,
                'proof_note' => $options['proof_note'] ?? null,
            ],
        ];
    }

    public function verifyWebhook(array $payload, array $headers = []): array
    {
        throw new \LogicException('Bank transfers are settled through the authenticated staff flow.');
    }
}
