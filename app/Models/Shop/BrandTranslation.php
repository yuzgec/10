<?php

namespace App\Models\Shop;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandTranslation extends Model
{

    use HasFactory,HasSlug;
    public $timestamps = false;

    protected $translationForeignKey = 'brand_id';

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
        'desc',
        'seoTitle',
        'seoDesc',
        'seoKey'
    ];
} 