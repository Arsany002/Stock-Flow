<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Maps each warehouse to exactly one Laratrust team, per the Enterprise
     * PRD §6.1: "A warehouses.id may equal a teams.id, or teams carries a
     * warehouse_id FK — implementation detail; the app maps each warehouse
     * to exactly one team." `teams.id` is a Laratrust bigint, `warehouses.id`
     * is our own UUID, so a shared-PK approach isn't possible — this adds
     * the FK column instead.
     *
     * Inventory Manager role assignments scoped to a team (via
     * role_user.team_id) are how stock.move/stock.transfer become
     * warehouse-scoped — see WarehouseScopeMiddleware / StockPolicy.
     */
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->uuid('warehouse_id')->nullable()->unique()->after('id');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign(['warehouse_id']);
            $table->dropColumn('warehouse_id');
        });
    }
};
