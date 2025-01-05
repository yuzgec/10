<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    private array $languages;

    public function __construct()
    {
        $this->languages = config('app.languages', ['tr']);
    }

    public function creating(Product $product)
    {
        if (empty($product->slug)) {
            $this->generateSlug($product);
        }
    }

    public function updating(Product $product)
    {
        if ($product->isDirty('name')) {
            $this->generateSlug($product);
        }
    }

    private function generateSlug(Product $product)
    {
        $slug = [];
        foreach ($this->languages as $lang) {
            $name = is_array($product->name) ? ($product->name[$lang] ?? '') : $product->name;
            $slug[$lang] = Str::slug($name);
        }
        $product->slug = $slug;
    }
} 