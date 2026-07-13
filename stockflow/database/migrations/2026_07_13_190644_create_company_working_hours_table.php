<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The global company schedule ABAC falls back to when an action has no
     * permission_access_windows row of its own. One row per day_of_week
     * (0=Sunday..6=Saturday, PHP/Carbon convention) — see
     * docs/technical/abac.md.
     */
    public function up(): void
    {
        Schema::create('company_working_hours', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->uuid('id')->primary();
            $table->unsignedTinyInteger('day_of_week');
            $table->time('opens_at')->nullable();
            $table->time('closes_at')->nullable();
            $table->boolean('is_open')->default(true);
            $table->string('timezone')->default('Africa/Cairo');
            $table->timestamps();

            $table->unique('day_of_week');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_working_hours');
    }
};
