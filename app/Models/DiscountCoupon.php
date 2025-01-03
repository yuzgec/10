<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_discount_coupons')
                    ->withTimestamps();
    }

    public function isValid(): bool
    {
        if (!$this->status) {
            return false;
        }

        if ($this->max_uses && $this->used_count >= $this->max_uses) {
            return false;
        }

        if ($this->starts_at && now() < $this->starts_at) {
            return false;
        }

        if ($this->expires_at && now() > $this->expires_at) {
            return false;
        }

        return true;
    }

    public function calculateDiscount($amount)
    {
        if ($this->type === 'percentage') {
            return ($amount * $this->value) / 100;
        }
        return $this->value;
    }
} 