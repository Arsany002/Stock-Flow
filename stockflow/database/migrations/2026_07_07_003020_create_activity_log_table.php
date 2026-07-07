<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Custom activity log (no spatie/laravel-activitylog package), per
     * Enterprise PRD §6.9: id, causer_id, subject_type, subject_id, event,
     * properties json, created_at.
     *
     * `subject_id` is a plain string rather than `uuidMorphs()`/`morphs()`
     * because subjects span both UUID-keyed tables (Product, Order, ...)
     * and the existing bigint-keyed `users`/`roles`/`permissions` tables —
     * see the ERD mismatch note in canonical-decisions.md / this session's
     * output about `users.id` not being a UUID.
     */
    public function up(): void
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->uuid('id')->primary();
            $table->foreignId('causer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('subject_type')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('event');
            $table->json('properties')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['subject_type', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_log');
    }
};
