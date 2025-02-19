<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
    protected $table = 'attr_translations'; 

    protected $translationForeignKey = 'attr_id';
    
    public $timestamps = false;

    protected $fillable = ['name'];
} 