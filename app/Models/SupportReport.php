<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportReport extends BaseModel
{
     protected $table = 'support_report';
      protected $fillable = [
        'title',
        'description',
        'route_web',
        'url_photo',
        'priority',
        'checked',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
