<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageGallery extends Model implements TranslatableContract, HasMedia, Viewable
{
    use HasFactory, SoftDeletes, InteractsWithMedia, Translatable, InteractsWithViews;

    public $translatedAttributes = ['name', 'slug', 'short', 'desc', 'seoKey', 'seoDesc', 'seoTitle'];

    protected $table = 'image_galleries';
    protected $guarded = [];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeLang($query)
    {
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        });
    }

    public function scopeRank($query)
    {
        return $query->orderBy('rank', 'asc');
    }

    protected $casts = [
        'status' => StatusEnum::class,
    ];
}
