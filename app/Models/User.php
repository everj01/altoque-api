<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    public $timestamps = false;

    use HasApiTokens, HasUuids, SoftDeletes, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'idcard',
        'email',
        'password',
        'mfa_enabled',
        'mfa_secret',
        'timezone',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'id',
        'mfa_secret'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mfa_enabled'       => 'boolean',
        'is_active'         => 'boolean',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
        'password'          => 'hashed',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now();
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
            $model->updated_by = Auth::id();
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
            $model->saveQuietly();
        });
    }

    // Relaciones
    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }
}
