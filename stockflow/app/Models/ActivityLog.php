<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Custom activity log (no spatie/laravel-activitylog). `subject_type` /
 * `subject_id` are plain attributes rather than a morphTo relation because
 * subjects span both UUID-keyed and the existing bigint-keyed users/roles
 * tables — see the migration's docblock and this session's ERD mismatch note.
 */
class ActivityLog extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'activity_log';

    public $timestamps = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'properties' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function causer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
