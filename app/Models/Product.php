<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends BaseModel
{
    protected $fillable = [
        'tenant_id',
        'branch_id',
        'name',
        'price',
        'product_category_id',
        'is_available',
        'is_active',
    ];

    protected $casts = [
        'price'        => 'decimal:2',
        'is_available' => 'boolean',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
