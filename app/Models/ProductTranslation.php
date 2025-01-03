<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{

    protected $translationForeignKey = 'product_id';

    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'slug',
        'short',
        'desc',
        'purchase_note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
} 