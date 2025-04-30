<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'description',
        'price',
        'sale_price',
        'stock',
        'category_id',
        'is_active',
        'featured',
        'specifications'
    ];

    protected $casts = [
        'specifications' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

//    public function images()
//    {
//        return $this->hasMany(ProductImage::class);
//    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}
