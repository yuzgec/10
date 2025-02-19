<?php

namespace App\Models\Shop;

use App\Enums\ProductTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements HasMedia, TranslatableContract
{
    use SoftDeletes, InteractsWithMedia, Translatable, HasFactory;

    public $translatedAttributes = [
        'name',
        'slug',
        'short',
        'desc',
        'seoTitle',
        'seoDesc',
        'seoKey',
        'technical_desc',
        'cargo_desc'
    ];

    protected $fillable = [
        'type',
        'price',
        'discount_price',
        'special_price',
        'stock',
        'manage_stock',
        'sku',
        'barcode',
        'weight',
        'warranty',
        'status',
        'featured'
    ];

    protected $casts = [
        'type' => ProductTypeEnum::class,
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'special_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'manage_stock' => 'boolean',
        'status' => 'boolean',
        'featured' => 'boolean'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_variation_attributes')
            ->withPivot('attribute_value_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where(function($q) {
            $q->where('manage_stock', false)
              ->orWhere(function($q) {
                  $q->where('manage_stock', true)
                    ->where('stock', '>', 0);
              });
        });
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
} 