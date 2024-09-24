<?php


namespace App\Enums;


enum MediumEnum : int {

    case MAPS           = 1;
    case REFERENCE      = 2;
    case GOOGLEADS      = 3;
    case METAADS        = 4;
    case WEBSITE        = 5;
    case UNKNOWN        = 6;


    public function title(){
        return match ($this) {
             self::MAPS         => 'Google Maps',
             self::REFERENCE    => 'Referans',
             self::GOOGLEADS    => 'Google Reklam',
             self::METAADS      => 'MEta Reklam',
             self::WEBSITE      => 'Web Organik',
             self::UNKNOWN      => 'Bilinmiyor',
        };
    }
}