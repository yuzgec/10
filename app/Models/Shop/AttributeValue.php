<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class AttributeValue extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'attr_values';
    
    public $translatedAttributes = ['name'];
    protected $translationForeignKey = 'attr_value_id';

    protected $fillable = [
        'attr_id',
        'value'
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attr_id');
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'variation_attrs', 'attr_value_id', 'variation_id');
    }
} 