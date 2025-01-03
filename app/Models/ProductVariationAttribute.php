<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariationAttribute extends Model
{
    protected $fillable = [
        'variation_id',
        'attribute_id',
        'value_id'
    ];

    public $timestamps = false;

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }

    public function value()
    {
        return $this->belongsTo(ProductAttributeValue::class);
    }
} 