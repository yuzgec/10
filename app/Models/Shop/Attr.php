<?php

namespace App\Models\Shop;

use App\Enums\ProductAttributeType;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Attr extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    
    protected $guarded = [];
    
    public $translatedAttributes = ['name'];
    
    protected $casts = [
        'type' => ProductAttributeType::class,
        'is_searchable' => 'boolean',
        'is_filterable' => 'boolean'
    ];
    
    public function values()
    {
        return $this->hasMany(AttrValue::class, 'attr_id');
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attrs')
                    ->withPivot('attr_value_id');
    }
    
    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'variation_attrs', 'attr_id', 'variation_id')
                    ->withPivot('attr_value_id');
    }
} 