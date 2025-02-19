<?php

namespace App\Models\Shop;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{

    use HasSlug;
    public $timestamps = false;

    protected $translationForeignKey = 'product_id';

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs();
    }
    

    protected $fillable = [
        'name',
        'slug',
        'short',
        'desc',
        'seoTitle',
        'seoDesc',
        'seoKey'
    ];
} 