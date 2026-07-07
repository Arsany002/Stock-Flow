<?php

namespace App\Enums;

/**
 * import_rows.status — per-row outcome, distinct from the batch-level
 * ImportStatus (a batch can be "completed" while individual rows are
 * "failed" — FR-7.3: rows validate individually and don't fail the file).
 */
enum ImportRowStatus: string
{
    case Pending = 'pending';
    case Imported = 'imported';
    case Failed = 'failed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Imported => 'Imported',
            self::Failed => 'Failed',
        };
    }
}
