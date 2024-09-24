<?php


namespace App\Enums;


enum PaymentTypeEnum : int {
    case CASH           = 1;
    case EFT            = 2;
    case CREDITCARD     = 3;


    public function title(){
        return match ($this) {
             self::CASH         => 'Nakit',
             self::EFT          => 'EFT / Havale',
             self::CREDITCARD   => 'Kredi Kartı',
        };
    }

    public function color() : string{
        return match ($this) {
            self::CASH          => 'green',
            self::EFT           => 'red',
            self::CREDITCARD    => 'gray',
        };
    }
}