<?php

namespace App\Models;

use App\Enums\CustomerWorkStatusEnum;
use App\Enums\CustomerWorkPaymentStatusEnum;
use Illuminate\Database\Eloquent\Model;

class CustomerWork extends Model
{
    protected $fillable = [
        'customer_id',
        'offer_id',
        'status',
        'payment_status',
        'start_date',
        'delivery_date',
        'completed_date',
        'last_payment_date',
        'description',
        'notes',
        'progress',
        'total_amount',
        'advance_payment',
        'remaining_payment',
        'total_paid',
        'total_remaining',
        'created_by',
        'updated_by',
        'google_calendar_event_id'
    ];

    protected $casts = [
        'status' => CustomerWorkStatusEnum::class,
        'payment_status' => CustomerWorkPaymentStatusEnum::class,
        'start_date' => 'date',
        'delivery_date' => 'date',
        'completed_date' => 'date',
        'last_payment_date' => 'date',
        'progress' => 'integer',
        'total_amount' => 'decimal:2',
        'advance_payment' => 'decimal:2',
        'remaining_payment' => 'decimal:2',
        'total_paid' => 'decimal:2',
        'total_remaining' => 'decimal:2'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($work) {
            if (!$work->total_remaining) {
                $work->total_remaining = $work->total_amount;
            }
            if (!$work->total_paid) {
                $work->total_paid = 0;
            }
        });

        static::updating(function ($work) {
            $work->total_remaining = $work->total_amount - ($work->total_paid ?? 0);
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function offer()
    {
        return $this->belongsTo(CustomerOffer::class, 'offer_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function payments()
    {
        return $this->hasMany(CustomerPayment::class, 'customer_work_id');
    }

    public function getPaymentProgressAttribute()
    {
        if ($this->total_amount <= 0) {
            return 0;
        }
        return round(($this->total_paid / $this->total_amount) * 100);
    }

    public function getPaymentStatusTextAttribute()
    {
        if ($this->payment_status === CustomerWorkPaymentStatusEnum::COMPLETED) {
            return 'Ödeme Tamamlandı';
        }

        return sprintf(
            'Toplam: %s TL | Ödenen: %s TL | Kalan: %s TL (%s%%)',
            number_format($this->total_amount, 2),
            number_format($this->total_paid, 2),
            number_format($this->total_remaining, 2),
            $this->payment_progress
        );
    }
}
