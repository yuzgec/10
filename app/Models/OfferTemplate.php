<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferTemplate extends Model
{
    protected $fillable = [
        'name',
        'currency',
        'description',
        'terms',
        'notes',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];

    // Şablon kalemleri ilişkisi
    public function items()
    {
        return $this->hasMany(OfferTemplateItem::class);
    }

    // Şablondan teklif oluştur
    public function createOffer($customerId)
    {
        $offer = CustomerOffer::create([
            'customer_id' => $customerId,
            'name' => $this->name,
            'currency' => $this->currency,
            'desc' => $this->description,
            'terms' => $this->terms,
            'note' => $this->notes,
            'status' => 'Teklif',
            'offer_date' => now(),
            'valid_until' => now()->addMonth(),
        ]);

        // Şablon kalemlerini teklife kopyala
        foreach ($this->items as $item) {
            $offer->items()->create([
                'item_name' => $item->item_name,
                'unit' => $item->unit,
                'amount' => $item->amount,
                'discount' => $item->discount,
                'tax' => $item->tax,
                'total' => $this->calculateTotal($item)
            ]);
        }

        return $offer;
    }

    // Kalem toplam tutarını hesapla
    private function calculateTotal($item)
    {
        $subtotal = $item->unit * $item->amount;
        $discountAmount = $subtotal * ($item->discount / 100);
        $afterDiscount = $subtotal - $discountAmount;
        $taxAmount = $afterDiscount * ($item->tax / 100);
        return $afterDiscount + $taxAmount;
    }

    // Varsayılan şablonu al
    public static function getDefault()
    {
        return static::where('is_default', true)->first();
    }
}
