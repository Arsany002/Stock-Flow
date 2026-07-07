<?php

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->uuid('id')->primary();
            $table->uuidMorphs('payable');
            $table->enum('method', array_column(PaymentMethod::cases(), 'value'));
            $table->enum('status', array_column(PaymentStatus::cases(), 'value'))->default(PaymentStatus::Pending->value);
            $table->string('gateway_ref')->nullable()->unique();
            $table->decimal('amount', 12, 2);
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
