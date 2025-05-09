<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasSlug, HasFactory, InteractsWithMedia;

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

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductGallery::class)->where('is_primary', true);
    }

    public function getImageUrlAttribute()
    {
        if ($this->primaryImage) {
            return asset('storage/' . $this->primaryImage->image);
        }
        return asset('storage/default-product.jpg');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function createVariant(array $data)
    {
        return $this->variants()->create($data);
    }

    public function getActiveVariants()
    {
        return $this->variants()->where('is_active', true)->get();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
}
