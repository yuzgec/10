<?php

namespace App\Models;

use App\Enums\CustomerWorkStatusEnum;
use Illuminate\Database\Eloquent\Model;

class CustomerWork extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => CustomerWorkStatusEnum::class
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function offer()
    {
        return $this->belongsTo(CustomerOffer::class, 'offer_id');
    }
}
