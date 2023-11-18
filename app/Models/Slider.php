<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use CreatedUpdatedBy, HasFactory, SoftDeletes;

    const STATUS = [
        'active' => 1,
        'inactive' => 0,
    ];

    protected $table = 'sliders';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'image',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS['active']);
    }
}
