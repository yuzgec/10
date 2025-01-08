<?php

namespace App\Enums;

enum TaxStatus: string
{
    case TAXABLE = 'taxable';
    case NONE = 'none';
    case SHIPPING = 'shipping';

    public function label(): string
    {
        return match($this) {
            self::TAXABLE => 'Vergilendirilebilir',
            self::NONE => 'Vergisiz',
            self::SHIPPING => 'Sadece Kargo'
        };
    }
} 