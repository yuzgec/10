<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeTranslation extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'locale',
        'product_attribute_id'
    ];

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attribute_id');
    }
} 