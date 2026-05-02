<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends BaseModel
{
    protected $fillable = [
        'region_id',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
