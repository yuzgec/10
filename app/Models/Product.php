<?php

namespace App\Models;

use App\Enums\StatusEnum;

use Spatie\MediaLibrary\HasMedia;



use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\MorphMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract,HasMedia,Viewable
{
    use HasFactory,SoftDeletes,InteractsWithMedia,Translatable,InteractsWithViews;

    protected $guarded = [];
    protected $with = ['translations', 'variants.attributes', 'attributes'];

    public $translatedAttributes = 
    ['name',
     'slug',
     'short',
     'desc',
     'seoKey',
     'seoDesc',
     'seoTitle',
     'cargo_text',
     'campagin_text',
     'payment_text',
     'tab1_name',
     'tab1_content',
     'tab2_name',
     'tab2_content',
     'tab3_name',
     'tab3_content',
     'tab4_name',
     'tab4_content',
     'tab5_name',
     'tab5_content',
    ];

    public function brand(){
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    public function variants(){
        return $this->hasMany(ProductVariants::class);
    }

    public function attributes(){
        return $this->hasMany(ProductAttributes::class);
    }

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function faqs()
    {
        return $this->morphMany(Faq::class, 'faqable');
    }

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

    protected $casts = [
        'status' => StatusEnum::class,
    ];


    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function hasVariants(): bool
    {
        return $this->variants()->count() > 0;
    }

    public function getBasePrice()
    {
        return $this->hasVariants() 
            ? $this->variants()->min('price') 
            : $this->price;
    }

    public function isInStock(): bool
    {
        if ($this->hasVariants()) {
            return $this->variants()->where('stock', '>', 0)->exists();
        }
        return $this->stock > 0;
    }

}