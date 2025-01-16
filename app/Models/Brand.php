<?php

namespace App\Models;

use App\Services\MediaService;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function registerMediaCollections(): void
    {
        MediaService::registerMediaCollections($this);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        MediaService::registerMediaConversions($this, $media, false);
    }
} 