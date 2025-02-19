<?php

namespace App\Traits;

trait HasPriceTrait
{
    public function hasDiscount(): bool
    {
        return !is_null($this->discount_price) || !is_null($this->special_price);
    }

    public function getDiscountPercentageAttribute()
    {
        if (!$this->hasDiscount()) {
            return 0;
        }

        $originalPrice = $this->price;
        $finalPrice = $this->final_price;

        return round((($originalPrice - $finalPrice) / $originalPrice) * 100);
    }
}
