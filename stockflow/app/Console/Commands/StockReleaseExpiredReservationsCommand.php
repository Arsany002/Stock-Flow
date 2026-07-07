<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Skeleton only — releasing expired reservations needs a reservation-expiry
 * concept (e.g. a checkout hold's `expires_at`) that doesn't exist in the
 * schema yet. Once that's designed, this should page through expired holds
 * and call StockService::release() for each, per-row, so a single stuck row
 * can't block the rest of the batch.
 */
class StockReleaseExpiredReservationsCommand extends Command
{
    protected $signature = 'stock:release-expired-reservations';

    protected $description = 'Release stock reservations that have passed their expiry (skeleton — not yet implemented).';

    public function handle(): int
    {
        $this->warn('stock:release-expired-reservations is a skeleton: no reservation-expiry concept exists in the schema yet.');

        return self::SUCCESS;
    }
}
