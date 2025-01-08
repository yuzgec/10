<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOfferItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        'unit' => 'integer',
        'amount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    public function offer()
    {
        return $this->belongsTo(CustomerOffer::class, 'offer_id');
    }
}