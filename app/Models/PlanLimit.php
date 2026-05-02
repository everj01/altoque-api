<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanLimit extends BaseModel
{
    protected $fillable = [
        'plan_id',
        'feature_name',
        'limit_value',
        'category_value',
        'is_active',
    ];

    protected $casts = [
        'limit_value' => 'integer',
        'is_active'   => 'boolean',
        'deleted_at'  => 'datetime',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
