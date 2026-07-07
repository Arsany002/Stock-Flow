<?php

namespace App\Exceptions;

/**
 * Thrown when a payment webhook/callback fails signature verification, or
 * otherwise cannot be trusted enough to convert a reservation to sale_out.
 *
 * @see docs/project/canonical-decisions.md — webhooks are signature-verified
 *      and idempotent.
 */
class PaymentVerificationException extends DomainException
{
    public static function invalidSignature(string $method): self
    {
        return new self(
            "Webhook signature verification failed for payment method [{$method}].",
            ['method' => $method]
        );
    }
}
