<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeTranslation extends Model
{
    use HasSlug;

    public $timestamps = false;
    
    protected $guarded = [];
    protected $table = 'product_attribute_translations';


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

} 