<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends BaseModel
{
    public $timestamps = false;

    use HasUuids, SoftDeletes;

    protected $fillable = [
        'uuid',
        'tenant_id',
        'subscription_id',
        'invoice_number',
        'status',
        'total_amount',
        'currency',
        'payment_method',
        'payment_ref',
        'paid_at',
        'notes',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_active',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'paid_at'      => 'datetime',
        'is_active'    => 'boolean',
        'deleted_at'   => 'datetime',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    // Relaciones
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
