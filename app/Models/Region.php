<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends BaseModel
{
    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
