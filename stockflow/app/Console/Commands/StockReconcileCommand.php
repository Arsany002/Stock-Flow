<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Warehouse;
use App\Services\StockService;
use Illuminate\Console\Command;

/**
 * CI-checkable proof that stock_levels (the projection) matches
 * stock_movements (the immutable ledger) — see
 * docs/project/canonical-decisions.md §6 and StockService::reconcile().
 */
class StockReconcileCommand extends Command
{
    protected $signature = 'stock:reconcile {--product= : Limit to one product UUID} {--warehouse= : Limit to one warehouse UUID}';

    protected $description = 'Prove stock_levels matches the immutable stock_movements ledger; exits non-zero on any mismatch.';

    public function handle(StockService $stock): int
    {
        $product = $this->option('product') ? Product::query()->find($this->option('product')) : null;
        $warehouse = $this->option('warehouse') ? Warehouse::query()->find($this->option('warehouse')) : null;

        $results = $stock->reconcile($product, $warehouse);

        if ($results->isEmpty()) {
            $this->info('No (product, warehouse) pairs to reconcile.');

            return self::SUCCESS;
        }

        $this->table(
            ['Product', 'Warehouse', 'on_hand', 'ledger_on_hand', 'OK?', 'reserved', 'ledger_reserved', 'OK?'],
            $results->map(fn (array $row) => [
                $row['product_id'],
                $row['warehouse_id'],
                $row['on_hand'],
                $row['ledger_on_hand'],
                $row['on_hand_matches'] ? 'yes' : 'MISMATCH',
                $row['reserved'],
                $row['ledger_reserved'],
                $row['reserved_matches'] ? 'yes' : 'MISMATCH',
            ])->all()
        );

        $mismatches = $results->reject(fn (array $row) => $row['on_hand_matches'] && $row['reserved_matches']);

        if ($mismatches->isEmpty()) {
            $this->info("Reconciliation passed — all {$results->count()} row(s) match.");

            return self::SUCCESS;
        }

        $this->error("Reconciliation FAILED — {$mismatches->count()} of {$results->count()} row(s) mismatch.");

        return self::FAILURE;
    }
}
