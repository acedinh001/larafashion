<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    //

    // add fillable
    protected $fillable = [
        'product_id',
        'image',
        'is_primary',
        'sort_order',
    ];
    // add guaded

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
