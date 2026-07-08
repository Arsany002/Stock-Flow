<?php

use App\Enums\PaymentMethod;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('payments')
            ->where('method', 'fake')
            ->update(['method' => PaymentMethod::FakeGateway->value]);

        Schema::table('payments', function (Blueprint $table) {
            $table->enum('method', array_column(PaymentMethod::cases(), 'value'))->change();
        });
    }

    public function down(): void
    {
        DB::table('payments')
            ->where('method', PaymentMethod::FakeGateway->value)
            ->update(['method' => 'fake']);

        $values = collect(PaymentMethod::cases())
            ->map(fn (PaymentMethod $method) => $method === PaymentMethod::FakeGateway ? 'fake' : $method->value)
            ->all();

        Schema::table('payments', function (Blueprint $table) use ($values) {
            $table->enum('method', $values)->change();
        });
    }
};
