<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Enums\ProductAttributeType;

class ProductAttribute extends Model implements TranslatableContract
{
    use Translatable;

    public $translatedAttributes = ['name'];
    
    protected $fillable = [
        'slug',
        'type',
        'status',
        'rank'
    ];

    protected $casts = [
        'type' => ProductAttributeType::class,
        'status' => 'boolean'
    ];

    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }

} 