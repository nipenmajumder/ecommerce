<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, CreatedUpdatedBy, SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'barcode',
        'image',
        'description',
        'author_id',
        'buy_price',
        'sell_price',
        'status',
    ];
}
