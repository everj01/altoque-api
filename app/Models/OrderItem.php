<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends BaseModel
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
