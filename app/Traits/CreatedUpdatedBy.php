<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait CreatedUpdatedBy
{
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function createdUser()
    {
        return $this->hasOne(User::class, 'created_by', 'id');
    }

    public function updatedUser()
    {
        return $this->hasOne(User::class, 'created_by', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Model $model) {
            $model->setAttribute('created_by', auth()->id());
        });
        static::updating(function (Model $model) {
            $model->setAttribute('updated_by', auth()->id());
        });
    }
}
