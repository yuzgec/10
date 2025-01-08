<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class ProductAttributeValue extends Model
{
    use Translatable;

    protected $fillable = [
        'product_attribute_id',
        'color_code',
        'sort_order'
    ];

    public $translatedAttributes = ['value', 'slug'];
    public $translationModel = ProductAttributeValueTranslation::class;
    public $translationForeignKey = 'product_attribute_value_id';

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }
} 