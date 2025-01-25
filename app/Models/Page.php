<?php

namespace App\Models;

use App\Enums\StatusEnum;

use App\Services\MediaService;
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

class Page extends Model implements TranslatableContract,HasMedia,Viewable
{
    use HasFactory,SoftDeletes,InteractsWithMedia,Translatable,InteractsWithViews;

    public $translatedAttributes = ['name', 'slug','short','desc','seoKey', 'seoDesc', 'seoTitle','title1','desc1','title2','desc2','title3','desc3'];

    protected $table = 'pages';
    protected $guarded = [];

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    
    public function faqs(){
        return $this->morphMany(Faq::class, 'faqable');
    }
    public function registerMediaCollections(): void
    {
        MediaService::registerMediaCollections($this);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        MediaService::registerMediaConversions($this, $media, false);
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

    protected $casts = [
        'status' => StatusEnum::class,
    ];

}
