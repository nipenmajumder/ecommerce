<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purchase extends Model
{
    use CreatedUpdatedBy, HasFactory;

    protected $table = 'purchases';

    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'invoice',
        'total_quantity',
        'subtotal',
        'total',
        'status',
    ];

    const STATUS = [
        'approved' => 1,
        'pending' => 2,
        'cancelled' => 3,
    ];

    public function purchaseDetails(): HasMany
    {
        return $this->hasMany(PurchaseDetails::class, 'purchase_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
