<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class AttributeValueTranslation extends Model
{
    public $timestamps = false;

    protected $table = 'attr_value_translations';

    protected $fillable = ['name'];

    protected $foreignKey = 'attr_value_id';
} 