<?php

use App\Enums\ImportEntity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('import_batches', function (Blueprint $table) {
            $table->string('file_path')->nullable()->after('entity');
            $table->string('original_filename')->nullable()->after('file_path');
            $table->enum('entity', array_column(ImportEntity::cases(), 'value'))->change();
        });
    }

    public function down(): void
    {
        Schema::table('import_batches', function (Blueprint $table) {
            $table->dropColumn(['file_path', 'original_filename']);

            $values = collect(ImportEntity::cases())
                ->reject(fn (ImportEntity $entity) => $entity === ImportEntity::Warehouses)
                ->map(fn (ImportEntity $entity) => $entity->value)
                ->all();

            $table->enum('entity', $values)->change();
        });
    }
};
