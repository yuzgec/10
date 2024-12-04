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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract,HasMedia,Viewable
{
    use HasFactory,SoftDeletes,NodeTrait,InteractsWithMedia,Translatable,InteractsWithViews;


    protected $table = 'categories';
    protected $guarded = [];

    public $translatedAttributes = ['name', 'slug','short','desc','seoKey', 'seoDesc', 'seoTitle'];



    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function registerMediaCollections(): void
    {

        $this
        ->addMediaCollection('page')
        ->useFallbackUrl('/backend/resimyok.jpg', 'thumb')
        ->useFallbackUrl('/backend/resimyok.jpg', 'small')
        ->useFallbackUrl('/backend/resimyok.jpg', 'icon')
        ->registerMediaConversions(function (Media $media) {
            $this
            ->addMediaConversion('img')
            ->width(1250)
            ->nonOptimized();

            $this
            ->addMediaConversion('thumb')
            ->width(500)
            ->nonOptimized();
                
            $this
            ->addMediaConversion('small')
            ->width(250)
            ->nonOptimized();
                     
            $this
            ->addMediaConversion('icon')
            ->width(100)
            ->nonOptimized();

        });
    }

    public function scopeLang($query){
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        });
    }

    protected $casts = [
        'status' => StatusEnum::class,
    ];
    

}
