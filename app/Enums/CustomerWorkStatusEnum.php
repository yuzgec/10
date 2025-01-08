<?php

namespace App\Enums;

enum CustomerWorkStatusEnum : int {
    case WORKING      = 1;
    case DONE         = 2;
    case CANCELLED    = 3;
    case PAID         = 4;

    public function title(): string{
        return match ($this) {
             self::WORKING          => 'Çalışılıyor',
             self::DONE             => 'Tamamlandı',
             self::CANCELLED        => 'İptal',
             self::PAID             => 'Ödeme Bekliyor',
        };
    }

    public function color() : string{
        return match ($this) {
            self::WORKING           => 'gray',
            self::DONE              => 'green',
            self::CANCELLED         => 'red',
            self::PAID              => 'yellow',
        };
    }
}