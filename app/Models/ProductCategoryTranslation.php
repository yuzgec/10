<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryTranslation extends Model
{
    public $timestamps = false;


    protected $translationForeignKey = 'product_category_id';


    protected $fillable = [
        'name',
        'slug',
        'short',
        'desc',
        'seoTitle',
        'seoDesc',
        'seoKey'
    ];
} 