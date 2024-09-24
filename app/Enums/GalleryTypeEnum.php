<?php

namespace App\Enums;

enum GalleryTypeEnum : int {

    case IMAGE = 1;
    case VIDEO = 2;
    case AUDIO = 3;

    public function title() : string {
        
        return match ($this) {
             self::IMAGE => 'Resim',
             self::VIDEO => 'Video',
             self::AUDIO => 'Ses',
        };
    }

    public function color() : string{
        return match ($this) {
            self::IMAGE => 'green',
            self::VIDEO => 'red',
            self::AUDIO => 'gray',
        };
    }

}