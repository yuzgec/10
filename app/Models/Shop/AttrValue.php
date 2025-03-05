<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class AttrValue extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    
    protected $guarded = [];
    
    public $translatedAttributes = ['name'];
    
    public function attribute()
    {
        return $this->belongsTo(Attr::class, 'attr_id');
    }
    
    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'variation_attrs', 'attr_value_id', 'variation_id');
    }
} 