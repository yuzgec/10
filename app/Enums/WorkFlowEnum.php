<?php


namespace App\Enums;


enum WorkFlowEnum : int {
    case TODO         = 1;
    case RESEARCH     = 2;
    case PENDING      = 3;
    case DONE         = 4;


    public function title(): string{
        return match ($this) {
             self::TODO             => 'Yap',
             self::RESEARCH         => 'Araştır',
             self::PENDING          => 'Bekle',
             self::DONE             => 'OK',
        };
    }

    public function color() : string{
        return match ($this) {
            self::TODO              => 'gray',
            self::RESEARCH          => 'yellow',
            self::PENDING           => 'blue',
            self::DONE              => 'green',
      
        };
    }
}