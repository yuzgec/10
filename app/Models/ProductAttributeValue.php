<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class ProductAttributeValue extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name', 'slug'];
    protected $guarded = [];
    protected $table = 'product_attribute_values';

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }

 
} 