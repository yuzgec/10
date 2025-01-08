<?php

namespace App\Enums;

enum CustomerEnum : int {
    case CUSTOMER       = 7;
    case NEW            = 6;
    case INTERESTED     = 1;
    case NOTINTERESTED  = 2;
    case WILLTHINK      = 3;
    case BAN            = 4;
    case OFFERGIVEN     = 5;


    public function title(): string{
        return match ($this) {
             self::NEW              => 'Yeni Müşteri',
             self::INTERESTED       => 'İlgileniyor',
             self::NOTINTERESTED    => 'İlgilenmiyor',
             self::WILLTHINK        => 'Düşünecek',
             self::BAN              => 'Aranmayacak',
             self::OFFERGIVEN       => 'Teklif Verildi',
             self::CUSTOMER         => 'Müşteri',
        };
    }

    public function color() : string{
        return match ($this) {
            self::NEW               => 'black',
            self::INTERESTED        => 'green',
            self::NOTINTERESTED     => 'orange',
            self::WILLTHINK         => 'blue',
            self::BAN               => 'red',
            self::OFFERGIVEN        => 'yellow',
            self::CUSTOMER          => 'purple',

        };
    }
}