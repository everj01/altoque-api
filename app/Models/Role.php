<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends BaseModel
{
    protected $fillable = [
        'tenant_id',
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

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions')
                    ->withPivot(['is_active', 'created_by', 'created_at'])
                    ->withTimestamps();
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }
}
