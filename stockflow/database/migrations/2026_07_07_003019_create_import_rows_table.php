<?php

use App\Enums\ImportRowStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('import_rows', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->uuid('id')->primary();
            $table->foreignUuid('import_batch_id')->constrained('import_batches')->cascadeOnDelete();
            $table->unsignedInteger('row_number');
            $table->json('payload');
            $table->enum('status', array_column(ImportRowStatus::cases(), 'value'))->default(ImportRowStatus::Pending->value);
            $table->string('error')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_rows');
    }
};
