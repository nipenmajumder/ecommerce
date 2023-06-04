<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
