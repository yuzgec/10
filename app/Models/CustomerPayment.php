<?php

namespace App\Models;

use App\Enums\CustomerPaymentStatusEnum;
use App\Enums\CustomerPaymentTypeEnum;
use App\Casts\PaymentTypeEnumCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPayment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
        'status' => CustomerPaymentStatusEnum::class,
        'payment_type' => PaymentTypeEnumCast::class,
    ];

    public function offer()
    {
        return $this->belongsTo(CustomerOffer::class, 'offer_id');
    }

    public function customerWork()
    {
        return $this->belongsTo(CustomerWork::class, 'customer_work_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
