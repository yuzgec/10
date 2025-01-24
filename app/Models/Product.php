<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use App\Enums\StatusEnum;
use Spatie\Image\Enums\Fit;
use App\Enums\ProductTypeEnum;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract, HasMedia
{
    use SoftDeletes, Translatable, InteractsWithMedia,HasTags;

    public array $translatedAttributes = [
        'name',
        'slug',
        'short_description',
        'description',
        'seoTitle',
        'seoDesc',
        'seoKey'
    ];

    protected $fillable = [
        'category_id',
        'type',
        'sku',
        'price',
        'discount_price',
        'stock',
        'status',
        'brand_id',
        'rank'
    ];

    protected $casts = [
        'type' => ProductTypeEnum::class,
        'status' => StatusEnum::class,
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'product_attribute_relations')
            ->withPivot('value_id', 'is_variation', 'is_visible')
            ->withTimestamps();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile()
            ->useFallbackUrl('/backend/resimyok.jpg');

        $this->addMediaCollection('gallery')
            ->useFallbackUrl('/backend/resimyok.jpg');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if (!$media) {
            return;
        }

        $this->addMediaConversion('img')
            ->fit(Fit::Contain, 1250, 1250)
            ->nonOptimized()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('thumb')
            ->fit(Fit::Contain, 500, 500)
            ->nonOptimized()
            ->keepOriginalImageFormat();

        $this->addMediaConversion('small')
            ->fit(Fit::Contain, 250, 250)
            ->nonOptimized()
            ->keepOriginalImageFormat();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    // Spatie/Tags için type tanımı
    public static function getTagClassName(): string
    {
        return Tag::class;
    }

    // Tag tipini belirle
    public function tags()
    {
        return $this->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->where('type', 'product');
    }
} 