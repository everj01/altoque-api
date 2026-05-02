<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends BaseModel
{
    protected $fillable = [
        'name',
        'key',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_permissions')
                    ->withPivot(['is_active', 'created_by', 'created_at'])
                    ->withTimestamps();
    }
}
