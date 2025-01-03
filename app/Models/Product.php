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
    use HasFactory,SoftDeletes,InteractsWithMedia,Translatable,InteractsWithViews;
    
    public $translatedAttributes = ['name', 'slug','short','desc','seoKey', 'seoDesc', 'seoTitle'];

    protected $fillable = [
        'name', 'slug', 'short', 'desc', 'type',
        'price', 'discount_price', 'stock', 'sku',
        'featured', 'purchase_note', 'tax_status',
        'tax_class', 'manage_stock', 'weight',
        'dimension_unit', 'length', 'width', 'height',
        'external_url', 'button_text', 'status',
        'campaign_text', 'cargo_text', 'warranty_text', 'pay_text', 'return_text', 'exchange_text', 'refund_text', 'cancel_text', 'contact_text'
    ];

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