<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends BaseModel
{
    protected $fillable = [
        'tenant_id',
        'plan_id',
        'status',
        'current_period_start',
        'current_period_end',
        'cancel_at_period_end',
        'external_subscription_id',
        'is_active',
    ];

    protected $casts = [
        'current_period_start' => 'datetime',
        'current_period_end'   => 'datetime',
        'cancel_at_period_end' => 'boolean',
        'is_active'            => 'boolean',
        'deleted_at'           => 'datetime',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
