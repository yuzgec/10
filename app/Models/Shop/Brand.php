<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Brand extends Model implements HasMedia, TranslatableContract
{
    use SoftDeletes, InteractsWithMedia, Translatable, HasFactory;

    public $translatedAttributes = [
        'name',
        'slug',
        'short',
        'desc',
        'seoTitle',
        'seoDesc',
        'seoKey'
    ];

    protected $fillable = [
        'status',
        'featured'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
} 