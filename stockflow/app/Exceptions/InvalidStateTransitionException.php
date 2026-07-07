<?php

namespace App\Exceptions;

/**
 * Thrown when a service is asked to move a stateful entity (Order, Quote,
 * PurchaseOrder, ...) to a status its current status cannot transition to.
 *
 * @see docs/project/canonical-decisions.md — state machines are explicit;
 *      illegal transitions throw domain exceptions.
 */
class InvalidStateTransitionException extends DomainException
{
    public static function make(string $entity, string $from, string $to): self
    {
        return new self(
            "Cannot transition {$entity} from [{$from}] to [{$to}].",
            ['entity' => $entity, 'from' => $from, 'to' => $to]
        );
    }
}
