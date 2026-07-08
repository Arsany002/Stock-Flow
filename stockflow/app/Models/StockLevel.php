<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Denormalized projection of stock_movements, and the row locked
 * (SELECT ... FOR UPDATE) during reserve/confirm/transfer. `available` is
 * always computed, never stored — see docs/project/canonical-decisions.md §6.
 *
 * @property-read int $available
 * @property-read Warehouse $warehouse
 */
class StockLevel extends Model
{
    use HasFactory, HasUuids;

    const UPDATED_AT = 'updated_at';

    const CREATED_AT = null;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'on_hand' => 'integer',
            'reserved' => 'integer',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    protected function available(): Attribute
    {
        return Attribute::get(fn () => $this->on_hand - $this->reserved);
    }
}
