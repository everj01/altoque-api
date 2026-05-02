<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends BaseModel
{
    protected $fillable = [
        'tenant_id',
        'branch_id',
        'order_number',
        'status',
        'order_type',
        'total_amount',
        'table_number',
        'is_active',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'is_active'    => 'boolean',
        'deleted_at'   => 'datetime',
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
