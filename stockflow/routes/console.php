<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Releases abandoned B2C checkout reservations — see
// App\Console\Commands\StockReleaseExpiredReservationsCommand.
Schedule::command('stock:release-expired-reservations')->everyMinute();
