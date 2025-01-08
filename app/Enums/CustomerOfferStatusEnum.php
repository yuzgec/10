<?php

namespace App\Enums;

enum CustomerOfferStatusEnum : int {
    case OFFER       = 1;
    case APPROVED    = 2;
    case COMPLETED   = 3;
    case CANCELLED   = 4;
    case REJECTED    = 5;
    case EXPIRED     = 6;
    case WAITING     = 7;
    case SENT        = 8;
    case RECEIVED    = 9;


    public function title(){
        return match ($this) {
            self::OFFER       => 'Teklif Verildi',
            self::APPROVED    => 'Onaylandı',
            self::COMPLETED   => 'Tamamlandı',
            self::CANCELLED   => 'İptal Edildi',
            self::REJECTED    => 'Reddedildi',
            self::EXPIRED     => 'Süre Doldu',
            self::WAITING     => 'Bekliyor',
            self::SENT        => 'Gönderildi',
            self::RECEIVED    => 'Alındı',

        };
    }

    public function color() : string{
        return match ($this) {
            self::OFFER       => 'green',
            self::APPROVED    => 'orange',
            self::COMPLETED   => 'blue',
            self::CANCELLED   => 'red',
            self::REJECTED    => 'red',
            self::EXPIRED     => 'gray',
            self::WAITING     => 'yellow',
            self::SENT        => 'purple',
            self::RECEIVED    => 'blue',
        };
    }
 
}