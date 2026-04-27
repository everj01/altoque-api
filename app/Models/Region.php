<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends BaseModel
{
    public $timestamps = false;

    use HasUuids, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    // Relaciones
    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
