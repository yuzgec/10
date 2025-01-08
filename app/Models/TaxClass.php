<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'slug', 'rate'];
    
    protected $casts = [
        'rate' => 'float'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    

} 