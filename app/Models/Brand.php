<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'slug', 'status'];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
} 