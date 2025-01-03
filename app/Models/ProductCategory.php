<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductCategory extends Model implements TranslatableContract, HasMedia
{
    use SoftDeletes, Translatable, NodeTrait, InteractsWithMedia;

    protected $table = 'product_categories';
    
    public $translatedAttributes = ['name', 'slug', 'short', 'desc', 'seoTitle', 'seoDesc', 'seoKey'];
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'product_category_id', 'product_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeLang($query)
    {
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', '=', app()->getLocale());
        });
    }
}