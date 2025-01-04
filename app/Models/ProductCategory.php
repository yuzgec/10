<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class ProductCategory extends Model implements TranslatableContract, HasMedia
{
    use SoftDeletes, Translatable, NodeTrait, InteractsWithMedia;

    protected $table = 'product_categories';
    
    public $translatedAttributes = ['name', 'slug', 'short', 'desc', 'seoTitle', 'seoDesc', 'seoKey'];
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'product_category_id', 'product_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeLang($query)
    {
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        });
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

}