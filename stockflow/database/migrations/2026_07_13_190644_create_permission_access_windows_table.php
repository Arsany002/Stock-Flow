<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Stricter, action/permission-specific schedule that overrides
     * company_working_hours when a matching row exists (see
     * AccessWindowService::hasActiveWindows()). `role_id` is nullable and
     * a plain unsignedBigInteger (roles.id is bigint, not UUID — see the
     * ERD deviation note in CLAUDE.md) — null means "applies to any role
     * holding permission_name". Supports overnight ranges (e.g.
     * 22:00 -> 06:00) via AccessWindowService::isTimeInsideWindow().
     */
    public function up(): void
    {
        Schema::create('permission_access_windows', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->uuid('id')->primary();
            $table->string('permission_name');
            $table->string('action')->nullable();
            $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
            $table->unsignedTinyInteger('day_of_week');
            $table->time('starts_at');
            $table->time('ends_at');
            $table->string('timezone')->default('Africa/Cairo');
            $table->boolean('is_active')->default(true);
            $table->boolean('bypass_for_super_admin')->default(true);
            $table->timestamps();

            $table->index(['permission_name', 'action', 'day_of_week'], 'paw_permission_action_day_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_access_windows');
    }
};
