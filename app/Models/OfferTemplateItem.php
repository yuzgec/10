<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferTemplateItem extends Model
{
    protected $fillable = [
        'offer_template_id',
        'item_name',
        'unit',
        'amount',
        'discount',
        'tax'
    ];

    protected $casts = [
        'unit' => 'integer',
        'amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2'
    ];

    // Şablon ilişkisi
    public function template()
    {
        return $this->belongsTo(OfferTemplate::class, 'offer_template_id');
    }

    // Toplam tutarı hesapla
    public function getTotal()
    {
        $subtotal = $this->unit * $this->amount;
        $discountAmount = $subtotal * ($this->discount / 100);
        $afterDiscount = $subtotal - $discountAmount;
        $taxAmount = $afterDiscount * ($this->tax / 100);
        return $afterDiscount + $taxAmount;
    }
} 