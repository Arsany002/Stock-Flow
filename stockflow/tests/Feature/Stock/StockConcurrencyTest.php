<?php

namespace Tests\Feature\Stock;

use App\Models\Product;
use App\Models\Warehouse;
use App\Services\StockService;
use Tests\Concerns\UsesRealMysqlDatabase;
use Tests\TestCase;

/**
 * Proves no-oversell under real concurrency (rule #10/#9 in
 * docs/project/canonical-decisions.md §6) — two genuinely separate DB
 * connections racing to reserve the last unit of stock. This needs real
 * MySQL row locking (SELECT ... FOR UPDATE), which SQLite (the suite's
 * default) can't provide, so it uses UsesRealMysqlDatabase like
 * DatabaseSchemaTest.
 */
class StockConcurrencyTest extends TestCase
{
    use UsesRealMysqlDatabase;

    private static bool $migrated = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->useRealMysqlDatabase();

        if (! self::$migrated) {
            $this->migrateRealMysqlDatabaseOnce();
            self::$migrated = true;
        }
    }

    protected function tearDown(): void
    {
        $this->restoreOriginalDatabaseConnection();

        parent::tearDown();
    }

    public function test_concurrent_reservation_for_last_unit_gives_exactly_one_success(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();

        app(StockService::class)->purchaseIn($product, $warehouse, 1, null, null);

        [$outputA, $outputB] = $this->runConcurrentReservations($product->id, $warehouse->id);

        $outcomes = [$outputA, $outputB];
        $successes = array_filter($outcomes, fn (string $o) => $o === 'OK');
        $failures = array_filter($outcomes, fn (string $o) => str_starts_with($o, 'FAIL:'));

        $this->assertCount(1, $successes, "Expected exactly one success, got: {$outputA} / {$outputB}");
        $this->assertCount(1, $failures);
        $this->assertStringContainsString('OutOfStockException', array_values($failures)[0]);

        $level = app(StockService::class)->reconcile($product, $warehouse)->first();
        $this->assertSame(1, $level['on_hand']);
        $this->assertSame(1, $level['reserved']);
        $this->assertTrue($level['on_hand_matches']);
        $this->assertTrue($level['reserved_matches']);
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function runConcurrentReservations(string $productId, string $warehouseId): array
    {
        $script = base_path('tests/Concurrency/reserve_once.php');

        $env = array_merge($_ENV, [
            'DB_CONNECTION' => 'mysql',
            'DB_DATABASE' => env('DB_TEST_DATABASE', 'stockflow_testing'),
            'DB_HOST' => env('DB_HOST', 'mysql'),
            'DB_PORT' => (string) env('DB_PORT', 3306),
            'DB_USERNAME' => env('DB_USERNAME', 'stockflow'),
            'DB_PASSWORD' => env('DB_PASSWORD', 'stockflow'),
        ]);

        $spec = [1 => ['pipe', 'w'], 2 => ['pipe', 'w']];
        $command = ['php', $script, $productId, $warehouseId, '1'];

        $processA = proc_open($command, $spec, $pipesA, base_path(), $env);
        $processB = proc_open($command, $spec, $pipesB, base_path(), $env);

        $outputA = stream_get_contents($pipesA[1]);
        $outputB = stream_get_contents($pipesB[1]);

        foreach ([$pipesA, $pipesB] as $pipes) {
            fclose($pipes[1]);
            fclose($pipes[2]);
        }

        proc_close($processA);
        proc_close($processB);

        return [$outputA, $outputB];
    }
}
