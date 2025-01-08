<?php

namespace App\Enums;
enum CustomerMediumEnum : int {

    case MAPS           = 1;
    case REFERENCE      = 2;
    case GOOGLEADS      = 3;
    case METAADS        = 4;
    case WEBSITE        = 5;
    case UNKNOWN        = 6;
    case GOZDE          = 7;
    case OLCAY          = 8;

    public function title(){
        return match ($this) {
             self::MAPS         => 'Google Maps',
             self::REFERENCE    => 'Referans',
             self::GOOGLEADS    => 'Google Reklam',
             self::METAADS      => 'Meta Reklam',
             self::WEBSITE      => 'Web Organik',
             self::UNKNOWN      => 'Bilinmiyor',
             self::GOZDE        => 'Canım Gözde',
             self::OLCAY        => 'Olcay',
        };
    }
}