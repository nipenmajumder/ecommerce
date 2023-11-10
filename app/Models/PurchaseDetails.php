<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PurchaseDetails extends Model
{
    use CreatedUpdatedBy;

    protected $table = 'purchase_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'invoice',
        'user_id',
        'purchase_id',
        'product_id',
        'purchase_price',
        'sell_price',
        'quantity',
        'total',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
