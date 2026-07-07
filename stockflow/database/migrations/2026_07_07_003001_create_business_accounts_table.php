<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * NOTE (ERD mismatch): the Enterprise PRD specifies UUID PKs everywhere,
     * including `users`. The existing `users` table (from an earlier
     * session) uses a bigint auto-increment id instead, so `user_id` here
     * is `foreignId` (unsignedBigInteger) to match it, not a UUID.
     */
    public function up(): void
    {
        Schema::create('business_accounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->uuid('id')->primary();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('company_name');
            $table->string('tax_id', 50)->nullable();
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->unsignedInteger('net_terms_days')->default(0);
            $table->decimal('outstanding_balance', 12, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_accounts');
    }
};
