<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FragmentStock extends Model
{
    use CreatedUpdatedBy;

    protected $connection = 'db_two';
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
    ];

    const STATUS = [
        'Stock' => 1,
        'Sale' => 2,
    ];
}
