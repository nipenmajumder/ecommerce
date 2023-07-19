<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'invoice',
        'user_id',
        'total_quantity',
        'subtotal',
        'total',
        'note',
        'status',
    ];

    const STATUS = [
        'pending' => 1,
        'processing' => 2,
        'completed' => 3,
        'cancelled' => 4,
        'refunded' => 3,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
