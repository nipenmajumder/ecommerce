<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
//        'purchase_details_id',
        'product_id',
        'product_sku',
        'product_barcode',
        'purchase_price',
        'sell_price',
        'stock_status',
    ];
    const STATUS = [
        'Stock' => 1,
        'Sale' => 2,
    ];
}
