<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VariationValue extends Pivot
{
    protected $table = 'variation_values';

    public $timestamps = false;

    protected $fillable = [
        'variation_id',
        'attribute_id',
        'value_id'
    ];

    // Özellik ilişkisi
    public function attribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id');
    }

    // Özellik değeri ilişkisi
    public function value()
    {
        return $this->belongsTo(ProductAttributeValue::class, 'value_id');
    }

    // Varyasyon ilişkisi
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    }
} 