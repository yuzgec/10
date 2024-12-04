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
        return $this->hasMany(ProductVariant::class);
    }

    public function attributes(){
        return $this->hasMany(ProductAttribute::class);
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

        $this->addMediaCollection('page')->useFallbackUrl('/backend/resimyok.jpg')->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('img')->width(1250)->nonOptimized();
            $this->addMediaConversion('thumb')->width(500)->nonOptimized();
            $this->addMediaConversion('small')->width(250)->nonOptimized();                     
            $this->addMediaConversion('icon')->width(100)->nonOptimized();
        });

        $this->addMediaCollection('gallery')->useFallbackUrl('/backend/resimyok.jpg')->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('img')->width(1250)->nonOptimized();
            $this->addMediaConversion('thumb')->width(500)->nonOptimized();
            $this->addMediaConversion('small')->width(250)->nonOptimized();                     
            $this->addMediaConversion('icon')->width(100)->nonOptimized();
        });

        $this->addMediaCollection('cover')->useFallbackUrl('/backend/resimyok.jpg')->registerMediaConversions(function (Media $media) {
            $this->addMediaConversion('img')->width(1250)->nonOptimized();
            $this->addMediaConversion('small')->width(250)->nonOptimized();                     
        });
    }

    protected $casts = [
        'status' => StatusEnum::class,
    ];


    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

}