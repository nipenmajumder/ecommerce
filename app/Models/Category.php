<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use CreatedUpdatedBy, HasFactory, SoftDeletes;

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

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        });
    }

    public function books(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
