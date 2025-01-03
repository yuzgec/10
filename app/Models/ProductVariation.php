<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'variation_key',
        'price',
        'discount_price',
        'stock',
        'weight',
        'length',
        'width',
        'height',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'length' => 'decimal:2',
        'width' => 'decimal:2',
        'height' => 'decimal:2',
        'status' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductVariationAttribute::class, 'variation_id');
    }

    public function getFinalPrice(): float
    {
        return $this->discount_price ?? $this->price;
    }

    public function hasDiscount(): bool
    {
        return !is_null($this->discount_price);
    }
} 