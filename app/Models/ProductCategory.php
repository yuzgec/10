<?php

namespace App\Models;

use App\Models\Product;
use App\Services\MediaService;
use App\Models\ProductCategory;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class ProductCategory extends Model implements TranslatableContract,HasMedia,Viewable
{
    use Translatable,InteractsWithMedia,NodeTrait,InteractsWithViews;

    protected $table = 'product_categories';
    
    protected $fillable = ['parent_id', 'order', 'status'];
    public $translatedAttributes = ['name', 'slug'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }

    public function allChildren(): HasMany
    {
        return $this->children()->with('allChildren');
    }

    public function getParentNames(): array
    {
        $names = [];
        $category = $this;
        
        while ($category->parent) {
            $names[] = $category->parent->name;
            $category = $category->parent;
        }
        
        return array_reverse($names);
    }

    public function getFullPathAttribute(): string
    {
        $path = $this->name;
        $category = $this;
        
        while ($category->parent) {
            $path = $category->parent->name . ' > ' . $path;
            $category = $category->parent;
        }
        
        return $path;
    }

    public function scopeLang($query)
    {
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
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