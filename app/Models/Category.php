<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, CreatedUpdatedBy, SoftDeletes;

    protected $table = 'categories';

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
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
