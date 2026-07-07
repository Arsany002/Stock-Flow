<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use PDO;

/**
 * Switches the test to a real MySQL connection instead of the suite's
 * default SQLite `:memory:` (see phpunit.xml) — for tests that need real
 * InnoDB semantics: FULLTEXT indexes, real FK/unique-constraint
 * enforcement, `SELECT ... FOR UPDATE` row locking, and real
 * (de)serialization. SQLite fakes some of these or doesn't support them at
 * all (e.g. it has no row-level locking, so a no-oversell concurrency test
 * against SQLite wouldn't actually prove anything).
 *
 * Always targets a dedicated `stockflow_testing` database on the same
 * server as dev — never the dev database itself.
 *
 * Usage: `use UsesRealMysqlDatabase;` in a test class, call
 * `$this->useRealMysqlDatabase();` in setUp() (after parent::setUp()),
 * and `$this->restoreOriginalDatabaseConnection();` in tearDown() (before
 * parent::tearDown()). Migrate the schema once per test class with a
 * `private static bool $migrated` guard — see DatabaseSchemaTest for the
 * pattern.
 */
trait UsesRealMysqlDatabase
{
    private string $originalDefaultConnection;

    private function useRealMysqlDatabase(): void
    {
        $this->originalDefaultConnection = Config::get('database.default');

        $testDatabase = env('DB_TEST_DATABASE', 'stockflow_testing');
        $appUser = env('DB_USERNAME', 'stockflow');

        // The app's normal DB user only has grants on the dev database, so
        // bootstrap the dedicated test database (and its grant) as root.
        $root = new PDO(
            sprintf('mysql:host=%s;port=%s', env('DB_HOST', 'mysql'), env('DB_PORT', 3306)),
            'root',
            env('DB_ROOT_PASSWORD', 'stockflow_root')
        );
        $root->exec(
            "CREATE DATABASE IF NOT EXISTS `{$testDatabase}` ".
            'DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci'
        );
        $root->exec("GRANT ALL PRIVILEGES ON `{$testDatabase}`.* TO '{$appUser}'@'%'");
        $root->exec('FLUSH PRIVILEGES');

        Config::set('database.connections.mysql.database', $testDatabase);
        Config::set('database.default', 'mysql');
        DB::purge('mysql');
    }

    private function migrateRealMysqlDatabaseOnce(): void
    {
        Artisan::call('migrate:fresh', ['--database' => 'mysql', '--force' => true]);
    }

    /**
     * Restore the suite's default (SQLite in-memory) connection so this
     * switch can never bleed into other test classes regardless of run
     * order.
     */
    private function restoreOriginalDatabaseConnection(): void
    {
        Config::set('database.default', $this->originalDefaultConnection);
        DB::purge('mysql');
    }
}
