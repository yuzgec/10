<?php

namespace App\Models\Shop;

use App\Enums\ProductAttributeType;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Attribute extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'attrs';
    
    public $translatedAttributes = ['name'];
    protected $translationForeignKey = 'attr_id';

    protected $fillable = [
        'type',
        'is_searchable',
        'is_filterable'
    ];

    protected $casts = [
        'is_searchable' => 'boolean',
        'is_filterable' => 'boolean',
        'type' => ProductAttributeType::class
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class, 'attr_id');
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'variation_attrs', 'attr_id', 'variation_id')
                    ->withPivot('attr_value_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_variation_attributes');
    }

    public function getOptionsAttribute()
    {
        return $this->values->pluck('name', 'id');
    }

    public function scopeSearchable($query)
    {
        return $query->where('is_searchable', true);
    }

    public function scopeFilterable($query)
    {
        return $query->where('is_filterable', true);
    }
} 