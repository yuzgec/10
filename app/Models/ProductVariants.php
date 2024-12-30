<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $with = ['attributes'];

    // Varyant için özel slug oluştur
    public function getSlug()
    {
        return $this->product->slug . '-' . Str::slug($this->name);
    }

    // Varyant fiyatını hesapla (indirim vs varsa)
    public function getFinalPrice()
    {
        if ($this->discount_price && $this->discount_price < $this->price) {
            return $this->discount_price;
        }
        return $this->price;
    }

    // Stok kontrolü
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function attributes(){
        return $this->hasMany(ProductVariantAttribute::class);
    }

    // Medya koleksiyonları
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('variant')
            ->useFallbackUrl('/backend/resimyok.jpg')
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('img')->width(1250)->nonOptimized();
                $this->addMediaConversion('thumb')->width(500)->nonOptimized();
                $this->addMediaConversion('small')->width(250)->nonOptimized();
            });
    }
}