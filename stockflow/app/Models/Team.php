<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laratrust\Models\Team as LaratrustTeam;

class Team extends LaratrustTeam
{
    public $guarded = [];

    /**
     * The parent Laratrust\Models\Team declares $fillable =
     * ['name', 'display_name', 'description']. Since that property is
     * non-empty, Eloquent uses it instead of falling back to our $guarded
     * above (redeclaring a parent's protected property doesn't erase it —
     * PHP property inheritance just shadows it, and Eloquent's
     * isFillable() checks $fillable first whenever it's non-empty). That
     * silently stripped `warehouse_id` from mass-assignment. Redeclaring
     * $fillable here to include it is the fix.
     */
    protected $fillable = ['name', 'display_name', 'description', 'warehouse_id'];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }
}
