<?php

namespace App\Observers;

use App\Models\Shop\Product;
use App\Enums\ProductTypeEnum;

class ProductObserver
{
    public function creating(Product $product)
    {
        if ($product->type === ProductTypeEnum::SIMPLE) {
            $product->manage_stock = true;
        }
    }

    public function updating(Product $product)
    {
        // Stok kontrolü ve otomatik status güncelleme
        if ($product->isDirty('stock') && $product->manage_stock) {
            $product->status = $product->stock > 0;
        }
    }
}