<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * NOTE: deliberately no `quantity` column — stock is only ever the
     * ledger (stock_movements) and its projection (stock_levels). See
     * docs/project/canonical-decisions.md §6.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->uuid('id')->primary();
            $table->foreignUuid('category_id')->constrained('categories')->restrictOnDelete();
            $table->foreignUuid('supplier_id')->nullable()->constrained('suppliers')->nullOnDelete();
            $table->string('sku', 64)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // FULLTEXT is MySQL-only; the app's automated test suite runs
            // most feature tests against SQLite in-memory for speed (see
            // phpunit.xml), which has no FULLTEXT support at all and throws
            // rather than ignoring it. Real MySQL (dev, and
            // tests/Feature/Schema/DatabaseSchemaTest.php) still gets the
            // index; FR-3.2's fulltext search itself only ever runs on MySQL.
            if (Schema::getConnection()->getDriverName() === 'mysql') {
                $table->fullText('name');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
