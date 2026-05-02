<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends BaseModel
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'currency',
        'interval',
        'features',
        'is_active',
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'features'   => 'array',
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function limits(): HasMany
    {
        return $this->hasMany(PlanLimit::class);
    }
}
