<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends BaseModel
{
    protected $table = 'roles_permissions';

    protected $fillable = [
        'role_id',
        'permission_id',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }
}
