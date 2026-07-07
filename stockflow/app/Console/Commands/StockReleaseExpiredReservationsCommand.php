<?php

namespace App\Console\Commands;

use App\Services\OrderService;
use Illuminate\Console\Command;

/**
 * Releases every B2C order reservation whose `orders.reserved_until` has
 * passed without payment — the counterpart to StockService's "no oversell"
 * guarantee (an abandoned/unpaid checkout can't hold stock hostage
 * indefinitely). Each release goes through OrderService::cancel(), which
 * calls StockService::release() per line inside its own transaction, so one
 * bad row can't block the rest of the batch.
 *
 * Registered on the scheduler (routes/console.php) to run every minute —
 * see requirement #6: the scheduled *job* wiring is intentionally minimal
 * (a plain Schedule::command(), no dedicated queued Job class/retry/backoff
 * policy), since the release logic itself needed to be fully correct, not
 * the scheduling infrastructure around it.
 */
class StockReleaseExpiredReservationsCommand extends Command
{
    protected $signature = 'stock:release-expired-reservations';

    protected $description = 'Release stock reservations for B2C orders whose reserved_until has passed unpaid.';

    public function handle(OrderService $orders): int
    {
        $released = $orders->releaseExpiredReservations();

        $this->info("Released {$released} expired reservation(s).");

        return self::SUCCESS;
    }
}
