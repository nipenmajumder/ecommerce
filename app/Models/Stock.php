<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use CreatedUpdatedBy;

    protected $table = 'stocks';

    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'user_id',
        'purchase_id',
        'product_id',
        'product_sku',
        'product_barcode',
        'purchase_price',
        'sell_price',
        'stock_status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    const STATUS = [
        'Stock' => 1,
        'Sale' => 2,
    ];
}
