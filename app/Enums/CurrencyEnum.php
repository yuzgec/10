<?php


namespace App\Enums;


enum CurrencyEnum : int {
    case TRY     = 1;
    case DOLAR   = 2;
    case EURO    = 3;


    public function title(){
        return match ($this) {
             self::TRY      => 'Türk Lira',
             self::DOLAR    => 'Dolar',
             self::EURO     => 'Euro',
        };
    }
}