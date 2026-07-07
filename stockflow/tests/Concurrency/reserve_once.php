<?php

use App\Models\Product;
use App\Models\Warehouse;
use App\Services\StockService;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

/**
 * Standalone worker process for StockServiceConcurrencyTest — deliberately
 * NOT a Symfony\Process\Process-based helper (that package isn't a project
 * dependency) or an artisan command (reserving stock from the CLI with no
 * actor isn't a real product capability). It boots its own Laravel
 * application instance, connected to the same real MySQL test database as
 * the parent test process, and attempts exactly one StockService::reserve()
 * call. Two of these are launched concurrently via proc_open() so the
 * lockForUpdate() row lock in lockOrCreateLevel() is genuinely contended
 * between two separate DB connections/transactions.
 *
 * Usage: php reserve_once.php <productId> <warehouseId> <quantity>
 * Prints exactly "OK" or "FAIL:<ExceptionClass>" to stdout.
 */

require __DIR__.'/../../vendor/autoload.php';

/** @var Application $app */
$app = require __DIR__.'/../../bootstrap/app.php';

/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

[, $productId, $warehouseId, $quantity] = $argv;

$product = Product::query()->findOrFail($productId);
$warehouse = Warehouse::query()->findOrFail($warehouseId);

try {
    app(StockService::class)->reserve($product, $warehouse, (int) $quantity, null, null);
    fwrite(STDOUT, 'OK');
} catch (Throwable $e) {
    fwrite(STDOUT, 'FAIL:'.get_class($e));
}
