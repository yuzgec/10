<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Traits\LogsActivityTrait;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTranslation extends Model implements Viewable
{
    use LogsActivityTrait,HasFactory,HasSlug,InteractsWithViews;

    public $timestamps = false;

    protected $translationForeignKey = 'product_id';

    
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('name')
        ->saveSlugsTo('slug');
    }



} 