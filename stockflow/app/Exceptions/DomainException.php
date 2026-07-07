<?php

namespace App\Exceptions;

use RuntimeException;

/**
 * Base type for exceptions that represent a domain/business-rule failure
 * (as opposed to an infrastructure error). Services throw these; the
 * exception handler and/or controllers translate them into the appropriate
 * HTTP response (validation error bag, 403, 409, ...).
 *
 * See docs/project/canonical-decisions.md §2 — "Exceptions represent domain
 * failures" is an architecture rule, not just a naming convention.
 */
abstract class DomainException extends RuntimeException
{
    /**
     * Extra machine-readable context about the failure (e.g. product_id,
     * requested vs. available quantity). Safe to expose in API error
     * responses; never put secrets here.
     *
     * @var array<string, mixed>
     */
    protected array $context = [];

    /**
     * @param  array<string, mixed>  $context
     */
    public function __construct(string $message, array $context = [])
    {
        parent::__construct($message);

        $this->context = $context;
    }

    /**
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return $this->context;
    }
}
