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
use App\Services\MediaService;

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
        MediaService::registerMediaCollections($this);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        MediaService::registerMediaConversions($this, $media, false);
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function scopeRank($query){
        return $query->orderBy('rank','asc');
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
