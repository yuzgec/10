<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Özellik tiplerini tanımla
    const TYPES = [
        'select' => 'Seçim',
        'color' => 'Renk',
        'size' => 'Beden',
        'text' => 'Metin',
        // ... diğer özellik tipleri
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function values(){
        return $this->hasMany(ProductAttributeValue::class);
    }
} 