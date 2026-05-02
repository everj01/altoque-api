<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

abstract class BaseModel extends Model
{
    use HasUuids, SoftDeletes;

    public $timestamps = false;

    protected $hidden = ['id'];

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
}
