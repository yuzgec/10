<?php

namespace App\Enums;

enum StatusEnum : int {
    case PUBLISHED      = 1;
    case UNPUBLISHED    = 2;
    case DRAFT          = 3;
    case LOCKED         = 4;

    public function title(){
        return match ($this) {
            self::UNPUBLISHED       => 'Yayınlanmamış',
            self::PUBLISHED         => 'Yayınlanmış',
            self::DRAFT             => 'Taslak',
            self::LOCKED            => 'Şifreli',
        };
    }

    public function color() : string{
        return match ($this) {
            self::PUBLISHED         => 'green',
            self::UNPUBLISHED       => 'orange',
            self::DRAFT             => 'yellow',
            self::LOCKED            => 'blue',
        };
    }

    public function id() : string{
        return match ($this) {
            self::PUBLISHED         => '',
            self::UNPUBLISHED       => 'showDateInput',
            self::DRAFT             => '',
            self::LOCKED            => 'showPassInput',
        };
    }
}