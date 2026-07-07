<?php

namespace App\Exceptions;

/**
 * Thrown during PO approval when a business account's outstanding_balance
 * plus the new PO total would exceed its credit_limit.
 *
 * @see docs/source/StockFlow-Enterprise-PRD.md.pdf FR-6.4.
 */
class CreditLimitExceededException extends DomainException
{
    public static function forBusinessAccount(string $businessAccountId, float $creditLimit, float $attemptedTotal): self
    {
        return new self(
            "Business account [{$businessAccountId}] credit limit of {$creditLimit} ".
            "would be exceeded by a total of {$attemptedTotal}.",
            [
                'business_account_id' => $businessAccountId,
                'credit_limit' => $creditLimit,
                'attempted_total' => $attemptedTotal,
            ]
        );
    }
}
