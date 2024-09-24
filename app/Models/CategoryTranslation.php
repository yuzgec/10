<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryTranslation extends Model implements Viewable
{
    use HasFactory,HasSlug,InteractsWithViews;


    public $timestamps = false;
    protected $guarded = [];

    protected $translationForeignKey = 'category_id';


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug')->allowDuplicateSlugs();
    }

}
