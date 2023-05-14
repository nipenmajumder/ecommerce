<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    use HasFactory, CreatedUpdatedBy, SoftDeletes;

    protected $table = 'publications';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'address',
        'description',
        'image',
        'status',
    ];
    const STATUS = [
        'active' => 1,
        'inactive' => 0,
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS['active']);
    }
}
