<?php

namespace App\Enums;


enum OrderStatusEnum : int {

    case PENDING        = 1;
    case PROCESSING     = 2;
    case CANCEL         = 3;
    case COMPLETE       = 4;
    case HALFPAID       = 5;


    public function title() : string{

        return match ($this) {
            self::PENDING       => 'Ödeme Bekleniyor',
            self::PROCESSING    => 'Hazırlanıyor',
            self::CANCEL        => 'İptal Edildi',
            self::COMPLETE      => 'Tamamlandı',
            self::HALFPAID      => 'İlk Ödeme',
        };
    }

    public function color() : string{

        return match ($this) {
            self::PENDING       => 'yellow',
            self::PROCESSING    => 'orange',
            self::CANCEL        => 'red',
            self::COMPLETE      => 'green',
            self::HALFPAID      => 'purple',
        };
    }
}