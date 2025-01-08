<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeRelation extends Model
{
    protected $table = 'product_attribute_relations';
    
    protected $fillable = [
        'product_id',
        'attribute_id',
        'value_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }

    public function value()
    {
        return $this->belongsTo(ProductAttributeValue::class, 'value_id');
    }
} 