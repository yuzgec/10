<?php

namespace App\Enums;

enum CustomerPaymentTypeEnum: int
{
    case ADVANCE = 1;
    case PROGRESS = 2;
    case FINAL = 3;

    public function title(): string
    {
        return match($this) {
            self::ADVANCE => 'Ön Ödeme',
            self::PROGRESS => 'Ara Ödeme',
            self::FINAL => 'Son Ödeme',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function fromMixed($value): self
    {
        if (is_string($value)) {
            $value = (int) $value;
        }
        return self::from($value);
    }
} 