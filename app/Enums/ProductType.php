<?php

namespace App\Enums;

enum ProductType: string
{
    case SIMPLE = 'simple';
    case VARIABLE = 'variable';
    case GROUPED = 'grouped';
    case EXTERNAL = 'external';

    public function label(): string
    {
        return match($this) {
            self::SIMPLE => 'Basit Ürün',
            self::VARIABLE => 'Varyasyonlu Ürün',
            self::GROUPED => 'Gruplanmış Ürün',
            self::EXTERNAL => 'Harici Ürün',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
} 