<?php

namespace App\Enums;

enum CustomerPaymentStatusEnum: int
{
    case PENDING = 1;
    case ADVANCE = 2;
    case PROGRESS = 3;
    case COMPLETED = 4;
    case CANCELLED = 5;

    public function title(): string
    {
        return match($this) {
            self::PENDING => 'Beklemede',
            self::ADVANCE => 'Ön Ödeme',
            self::PROGRESS => 'Ara Ödeme',
            self::COMPLETED => 'Tamamlandı',
            self::CANCELLED => 'İptal Edildi',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING => 'warning',
            self::ADVANCE => 'info',
            self::PROGRESS => 'primary',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
} 