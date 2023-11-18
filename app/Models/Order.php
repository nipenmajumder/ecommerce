<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use CreatedUpdatedBy,HasFactory;

    protected $fillable = [
        'date',
        'invoice',
        'user_id',
        'total_quantity',
        'total_vat',
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

    public static function generateInvoiceCode(): string
    {
        $lastInvoice = self::query()
            ->where('invoice', 'LIKE', 'INV'.'%')
            ->whereDate('date', today())
            ->latest()->count() ?? 0;

        return 'INV'.'-'.date('dmy').
            (str_pad((int) $lastInvoice + 1, 3, '0', STR_PAD_LEFT));
    }
}
