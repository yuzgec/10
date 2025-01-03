<?php

namespace App\Models;

use App\Enums\VideoEnum;

use App\Enums\StatusEnum;

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


class Video extends Model implements TranslatableContract,HasMedia,Viewable
{
    use HasFactory,SoftDeletes,InteractsWithMedia,Translatable,InteractsWithViews;

    protected $table = 'videos';
    protected $guarded = [];

    public $translatedAttributes = ['name', 'slug','short','desc','seoKey', 'seoDesc', 'seoTitle'];

    public function getCategory(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
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

    protected $casts = [
        'status' => StatusEnum::class,
        'type' => VideoEnum::class,
    ];

}
