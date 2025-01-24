<?php

namespace App\Models;

use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;

class ProductAttributeValueTranslation extends Model
{

    use HasSlug;

    protected $translationForeignKey = 'product_attribute_value_id';
    protected $table = 'product_attribute_value_translations';

    protected $guarded = [];
    public $timestamps = false;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
} 