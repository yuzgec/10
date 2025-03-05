<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Variation extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'discount_price',
        'special_price',
        'stock',
        'manage_stock',
        'barcode',
        'weight',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'special_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'manage_stock' => 'boolean',
        'status' => 'boolean'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attr::class, 'variation_attrs', 'variation_id', 'attr_id')
                    ->withPivot('attr_value_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttrValue::class, 'variation_attrs', 'variation_id', 'attr_value_id');
    }
    
    public function getFormattedPrice()
    {
        if (!empty($this->discount_price)) {
            return [
                'original' => number_format($this->price, 2, ',', '.'),
                'discounted' => number_format($this->discount_price, 2, ',', '.'),
                'discount_rate' => round((($this->price - $this->discount_price) / $this->price) * 100)
            ];
        }
        
        return [
            'original' => number_format($this->price, 2, ',', '.'),
            'discounted' => null,
            'discount_rate' => null
        ];
    }
} 