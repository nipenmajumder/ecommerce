<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory,CreatedUpdatedBy;

    protected $table = 'purchases';
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'invoice',
        'total_quantity',
        'subtotal',
        'total',
        'note',
        'status',
    ];

    const STATUS = [
        'approved' => 1,
        'pending' => 2,
        'cancelled' => 3,
    ];
}
