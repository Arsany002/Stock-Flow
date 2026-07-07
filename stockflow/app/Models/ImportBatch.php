<?php

namespace App\Models;

use App\Enums\ImportEntity;
use App\Enums\ImportStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ImportBatch extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'entity' => ImportEntity::class,
            'status' => ImportStatus::class,
            'total_rows' => 'integer',
            'success_rows' => 'integer',
            'failed_rows' => 'integer',
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function rows(): HasMany
    {
        return $this->hasMany(ImportRow::class);
    }
}
