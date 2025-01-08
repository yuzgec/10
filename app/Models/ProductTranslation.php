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

    protected $translationForeignKey = 'product_id';

    protected $guarded = [];
    public $timestamps = false;
    protected $logAttributes = ['name', 'slug'];

    public function getCustomAttributeNames()
    {
        return [ 'name' => 'Başlık', 'slug' => 'Link'];
    }

    
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
} 