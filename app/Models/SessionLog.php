<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'ip_address',
        'user_agent',
        'device',
        'platform',
        'browser',
        'is_mobile',
    ];

    protected $casts = [
        'is_mobile'  => 'boolean',
        'created_at' => 'datetime',
    ];

    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
