<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Links a Vendor/Supplier-role user to the supplier record they manage,
     * mirroring business_accounts.user_id for Business Buyers. Needed so
     * ProductPolicy/PriceListPolicy can enforce "own products / own price
     * list items only" (Enterprise PRD §3 permission matrix, "own" cells)
     * — nothing in the original schema linked a login user to a supplier.
     *
     * Nullable: not every supplier has a portal login (many are just
     * catalog metadata entered by staff).
     */
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->unique()->after('id')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
