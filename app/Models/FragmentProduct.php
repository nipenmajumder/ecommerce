<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FragmentProduct extends Model
{
    use CreatedUpdatedBy, SoftDeletes;

    protected $connection = 'db_two';
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'barcode',
        'category_id',
        'author_id',
        'publication_id',
        'buy_price',
        'sell_price',
        'image',
        'description',
        'status',
    ];

    const STATUS = [
        'active' => 1,
        'inactive' => 0,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }

    public function fragmentStocks(): HasMany
    {
        return $this->hasMany(FragmentStock::class, 'product_id', 'id');
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        });
    }
}
