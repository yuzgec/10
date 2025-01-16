<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Traits\LogsActivityTrait;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategoryTranslation extends Model implements Viewable
{
    use LogsActivityTrait,HasFactory,HasSlug,InteractsWithViews;
    public $timestamps = false;
    protected $guarded = [];


    protected $logAttributes = ['name', 'slug'];
    
    public function getCustomAttributeNames()
    {
        return [ 'name' => 'Başlık', 'slug' => 'Link'];
    }
    
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }
}