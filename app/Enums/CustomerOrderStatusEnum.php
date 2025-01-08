<?php

namespace App\Enums;

enum CustomerOrderStatusEnum : int {
    case PENDING        = 1;
    case CANCEL         = 3;
    case COMPLETE       = 4;
    case HALFPAID       = 5;

    public function title() : string{

        return match ($this) {
            self::PENDING       => 'Ödeme Bekleniyor',
            self::CANCEL        => 'İptal Edildi',
            self::COMPLETE      => 'Tamamlandı',
            self::HALFPAID      => 'İlk Ödeme',
        };
    }

    public function color() : string{

        return match ($this) {
            self::PENDING       => 'yellow',
            self::CANCEL        => 'red',
            self::COMPLETE      => 'green',
            self::HALFPAID      => 'purple',
        };
    }
}