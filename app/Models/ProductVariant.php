<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'name',
        'price',
        'sale_price',
        'stock',
        'attributes',
        'is_active'
    ];

    protected $casts = [
        'attributes' => 'array',
        'is_active' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeInStock(Builder $query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }
}
