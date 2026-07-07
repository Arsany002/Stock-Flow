<?php

namespace App\Enums;

/**
 * po_approvals.decision.
 */
enum ApprovalDecision: string
{
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match ($this) {
            self::Approved => 'Approved',
            self::Rejected => 'Rejected',
        };
    }
}
