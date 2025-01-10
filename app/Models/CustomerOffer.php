<?php

namespace App\Models;

use App\Enums\CurrencyEnum;
use App\Enums\CustomerOfferStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerOffer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer_offers';
    protected $guarded = [];

    protected $casts = [
        'status' => CustomerOfferStatusEnum::class,
        'currency' => CurrencyEnum::class,
        'offer_date' => 'date',
        'valid_until' => 'date',
        'sent_at' => 'datetime',
        'is_sent' => 'boolean',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(CustomerOfferItem::class, 'offer_id');
    }

    public function payments()
    {
        return $this->hasMany(CustomerPayment::class, 'offer_id');
    }

    public function customerWork()
    {
        return $this->hasOne(CustomerWork::class, 'offer_id');
    }

    // Teklif numarası oluşturma
    public static function generateOfferNumber(): string 
    {
        $lastOffer = self::orderBy('id', 'desc')->first();
        $number = $lastOffer ? (int)substr($lastOffer->offer_no, 3) + 1 : 1;
        return 'TKF' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }

    // Teklif PDF'i oluşturma
    public function generatePDF()
    {
        // PDF oluşturma işlemleri burada yapılacak
    }

    // Mail gönderme
    public function sendEmail()
    {
        // Mail gönderme işlemleri burada yapılacak
    }
}
