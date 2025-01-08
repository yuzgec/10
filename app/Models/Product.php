<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use App\Enums\ProductType;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;

use Illuminate\Database\Eloquent\Factories\HasFactory;



class Product extends Model implements TranslatableContract,HasMedia,Viewable
{
    use HasFactory,SoftDeletes,InteractsWithMedia,Translatable,InteractsWithViews,HasTags;
    
    public $translatedAttributes = ['name', 'slug','short','desc','seoKey', 'seoDesc', 'seoTitle'];

    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean',
        'manage_stock' => 'boolean',
        'status' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'type' => ProductType::class,
    ];

    // İlişkiler

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'category_product', 'product_id', 'product_category_id');
    }

    public function meta()
    {
        return $this->hasMany(ProductMeta::class);
    }

    // Yardımcı metodlar
    public function isVariable(): bool
    {
        return $this->type === ProductType::VARIABLE;
    }

    public function isSimple(): bool
    {
        return $this->type === ProductType::SIMPLE;
    }

    public function isGrouped(): bool
    {
        return $this->type === ProductType::GROUPED;
    }

    public function isExternal(): bool
    {
        return $this->type === ProductType::EXTERNAL;
    }

    public function getFinalPrice(): float
    {
        return $this->discount_price ?? $this->price;
    }

    public function hasDiscount(): bool
    {
        return !is_null($this->discount_price);
    }

    public function scopeLang($query){
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        });
    }

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_relations', 'product_id', 'attribute_id')
            ->withPivot('value_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(ProductAttributeValue::class, 'product_attribute_values_simple', 'product_id', 'value_id')
            ->withTimestamps();
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttributeRelation::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withoutGlobalScope('order');
    }

    // Media koleksiyonları
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('page')
            ->useFallbackUrl('/backend/resimyok.jpg');

        $this->addMediaCollection('gallery')
            ->useFallbackUrl('/backend/resimyok.jpg');

        $this->addMediaCollection('cover')
            ->useFallbackUrl('/backend/resimyok.jpg');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        if ($media === null) {
            return;
        }

        $this->addMediaConversion('img')
            ->width(1250)
            ->nonOptimized()
            ->keepOriginalImageFormat()
            ->performOnCollections('page', 'gallery', 'cover');

        $this->addMediaConversion('thumb')
            ->width(500)
            ->nonOptimized()
            ->keepOriginalImageFormat()
            ->performOnCollections('page', 'gallery');
            
        $this->addMediaConversion('small')
            ->width(250)
            ->nonOptimized()
            ->keepOriginalImageFormat()
            ->performOnCollections('page', 'gallery', 'cover');
                 
        $this->addMediaConversion('icon')
            ->width(100)
            ->nonOptimized()
            ->keepOriginalImageFormat()
            ->performOnCollections('page', 'gallery');
    }
} 