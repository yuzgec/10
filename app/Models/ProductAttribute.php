<?php

namespace App\Models;

use App\Enums\ProductAttributeType;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class ProductAttribute extends Model implements TranslatableContract
{
    use Translatable;


    public $translatedAttributes = ['name'];
    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
        'type' => ProductAttributeType::class
    ];


    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function scopeLang($query){
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        });
    }

    public function scopeRank($query){
        return $query->orderBy('rank','asc');
    }



    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class, 'attribute_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_relations')
            ->withPivot('value_id', 'is_variation', 'is_visible')
            ->withTimestamps();
    }
} 