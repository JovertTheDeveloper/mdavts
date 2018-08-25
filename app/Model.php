<?php

namespace App;

use Spatie\BinaryUuid\HasBinaryUuid;
use Spatie\BinaryUuid\HasUuidPrimaryKey;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    use HasBinaryUuid, HasUuidPrimaryKey;

    use SoftDeletes;

    protected $primaryKey = 'uuid';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'created_by')) {
                $model->created_by = optional(auth()->user())->uuid;
            }
        });

        static::updating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                $model->updated_by = optional(auth()->user())->uuid;
            }
        });

        static::deleting(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'deleted_by')) {
                $model->deleted_by = optional(auth()->user())->uuid;
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
