<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class, 'product_attribute_id');
    }

    public function translations()
    {
        return $this->hasMany(ProductAttributeTranslation::class, 'product_attribute_id');
    }
} 