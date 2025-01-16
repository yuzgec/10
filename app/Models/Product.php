<?php

namespace App\Models;

use App\Enums\ProductType;
use App\Services\MediaService;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract, HasMedia
{
    use Translatable, SoftDeletes, InteractsWithMedia;

    public $translatedAttributes = ['name', 'slug', 'description'];

    protected $fillable = [
        'sku',
        'price',
        'stock',
        'featured',
        'status',
        'brand_id',
        'tax_status',
        'tax_class_id',
        // Stok Yönetimi
        'manage_stock',
        'min_stock_level',
        'stock_status',
        'allow_backorders',
        'notify_low_stock',
        'low_stock_threshold',
        'show_stock_quantity',
        // Kargo & Teslimat
        'requires_shipping',
        'delivery_time',
        // Özel Alanlar
        'warranty_period',
        'manufacturing_place',
        'barcode'
    ];

    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
        'manage_stock' => 'boolean',
        'allow_backorders' => 'boolean',
        'notify_low_stock' => 'boolean',
        'show_stock_quantity' => 'boolean',
        'requires_shipping' => 'boolean',
        'price' => 'decimal:2',
        'stock' => 'integer',
        'min_stock_level' => 'integer',
        'low_stock_threshold' => 'integer',
        'delivery_time' => 'integer',
        'warranty_period' => 'integer',
        'type' => ProductType::class
    ];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function taxClass()
    {
        return $this->belongsTo(TaxClass::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'category_product');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(ProductAttributeValue::class, 'product_attribute_value');
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'product_related', 'product_id', 'related_product_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttributeRelation::class);
    }

    public function registerMediaCollections(): void
    {
        MediaService::registerMediaCollections($this);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        MediaService::registerMediaConversions($this, $media, true);
    }

    public function isLowStock(): bool
    {
        if (!$this->manage_stock || !$this->notify_low_stock || !$this->low_stock_threshold) {
            return false;
        }

        return $this->stock <= $this->low_stock_threshold;
    }

    public function canBackorder(): bool
    {
        return $this->manage_stock && $this->allow_backorders;
    }

    public function isInStock(): bool
    {
        if (!$this->manage_stock) {
            return true;
        }

        if ($this->stock_status === 'out_of_stock') {
            return false;
        }

        if ($this->stock_status === 'on_backorder') {
            return $this->canBackorder();
        }

        return $this->stock > 0;
    }

    public function getStockStatusTextAttribute(): string
    {
        if (!$this->manage_stock) {
            return 'Stok takibi kapalı';
        }

        switch ($this->stock_status) {
            case 'in_stock':
                return 'Stokta';
            case 'out_of_stock':
                return 'Stok yok';
            case 'on_backorder':
                return 'Ön sipariş';
            default:
                return 'Bilinmiyor';
        }
    }

    public function getDeliveryTimeTextAttribute(): string
    {
        if (!$this->requires_shipping) {
            return 'Kargo gerektirmez';
        }

        if (!$this->delivery_time) {
            return 'Belirtilmemiş';
        }

        return "{$this->delivery_time} gün";
    }

    
    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function scopeLang($query){
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        });
    }

    public function scopeRank($query){
        return $query->orderBy('rank','asc');
    }

    public function isVariable(): bool
    {
        return $this->type === ProductType::VARIABLE->value;
    }

    public function isSimple(): bool
    {
        return $this->type === ProductType::SIMPLE->value;
    }

} 