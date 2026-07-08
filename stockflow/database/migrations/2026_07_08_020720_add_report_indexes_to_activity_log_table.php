<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Supports the Audit Log page's causer + date-range filtering
 * (Admin/AuditLog/Index.jsx) without a full table scan. The migration
 * that created activity_log already indexes (subject_type, subject_id).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->index(['causer_id', 'created_at']);
            $table->index('event');
        });
    }

    public function down(): void
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropIndex(['causer_id', 'created_at']);
            $table->dropIndex(['event']);
        });
    }
};
