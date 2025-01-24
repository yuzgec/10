<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements HasMedia, TranslatableContract,Viewable
{
    use SoftDeletes, InteractsWithMedia, Translatable, NodeTrait,InteractsWithViews;

    protected $fillable = ['parent_id', 'rank', 'status'];
    public $translatedAttributes = ['name', 'slug', 'description'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
                    ->with('translations')
                    ->orderBy('rank');
    }

    // Tüm alt kategoriler (recursive)
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    // Üst kategori
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Tüm üst kategoriler
    public function allParents()
    {
        return $this->parent()->with('allParents');
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }


    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
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