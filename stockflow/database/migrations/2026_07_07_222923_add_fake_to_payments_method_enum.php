<?php

use App\Enums\PaymentMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Widens payments.method to include 'fake_gateway' (the demo/test gateway used by
 * B2C checkout — see app/Payments/FakeGateway.php). Uses the fluent
 * Blueprint::change() API rather than raw SQL so it runs on both MySQL (dev/
 * prod) and SQLite (the test suite's default connection, which recreates
 * the table under the hood for column changes).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('method', array_column(PaymentMethod::cases(), 'value'))->change();
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $values = collect(PaymentMethod::cases())
                ->reject(fn (PaymentMethod $m) => $m === PaymentMethod::FakeGateway)
                ->map(fn (PaymentMethod $m) => $m->value)
                ->all();

            $table->enum('method', $values)->change();
        });
    }
};
