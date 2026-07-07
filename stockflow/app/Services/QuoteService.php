<?php

namespace App\Services;

use App\Repositories\Contracts\QuoteRepositoryInterface;

/**
 * Skeleton only — RFQ request/pricing/accept/reject state machine (Epic 6,
 * draft → sent → accepted/rejected/expired) is implemented in the B2B
 * procurement module.
 */
class QuoteService
{
    public function __construct(private readonly QuoteRepositoryInterface $quotes) {}

    public function request(string $businessAccountId, array $lines): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function price(string $quoteId, array $lines): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function accept(string $quoteId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }

    public function reject(string $quoteId): void
    {
        throw new \LogicException(__METHOD__.' is not implemented yet.');
    }
}
