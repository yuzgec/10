<?php

namespace App\Enums;
enum CurrencyEnum: string {
    case TL = 'TRY';
    case USD = 'USD';
    case EUR = 'EUR';

    public function symbol(): string {
        return match ($this) {
            self::TL => '₺',
            self::USD => '$',
            self::EUR => '€',
        };
    }
}