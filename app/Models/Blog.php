<?php

namespace App\Models;

use Carbon\Carbon;

use App\Enums\StatusEnum;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Spatie\Activitylog\Traits\LogsActivity;

use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Blog extends Model implements TranslatableContract,HasMedia,Viewable
{
    use HasFactory,SoftDeletes,InteractsWithMedia,Translatable,InteractsWithViews;

    protected $table = 'blogs';
    protected $guarded = [];

    public $translatedAttributes = ['name', 'slug','short','desc','seoKey', 'seoDesc', 'seoTitle'];


   public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function scopeRank($query){
        return $query->orderBy('rank','desc');
    }

    public function scopeLang($query){
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        });
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d'); // Sadece tarih formatı
    }

    protected $casts = [
        'status' => StatusEnum::class,
    ];

}
