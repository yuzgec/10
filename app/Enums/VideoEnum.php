<?php

namespace App\Enums;

enum VideoEnum : int {
    case VIDEO     = 1;
    case SHORT     = 2;
    case OTHER     = 3;

    public function title(){
        return match ($this) {
             self::VIDEO      => 'Youtube Video',
             self::SHORT      => 'Youtube Short',
             self::OTHER      => 'Diğer Video',
        };
    }
}