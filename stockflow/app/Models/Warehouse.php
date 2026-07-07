<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Warehouse extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Every warehouse maps to exactly one Laratrust team, auto-created
     * below, so Inventory Manager role assignments can be scoped to it.
     * See docs/project/canonical-decisions.md §3 and the
     * add_warehouse_id_to_teams_table migration.
     */
    protected static function booted(): void
    {
        static::created(function (Warehouse $warehouse) {
            Team::query()->firstOrCreate(
                ['warehouse_id' => $warehouse->id],
                ['name' => $warehouse->code, 'display_name' => $warehouse->name]
            );
        });
    }

    public function team(): HasOne
    {
        return $this->hasOne(Team::class);
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function stockLevels(): HasMany
    {
        return $this->hasMany(StockLevel::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function poItems(): HasMany
    {
        return $this->hasMany(PoItem::class);
    }
}
