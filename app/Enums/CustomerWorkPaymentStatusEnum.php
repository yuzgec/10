<?php

namespace App\Enums;

enum CustomerWorkPaymentStatusEnum: int
{
    case PENDING = 1;
    case PARTIAL = 2;
    case COMPLETED = 3;

    public function title(): string
    {
        return match($this) {
            self::PENDING => 'Bekliyor',
            self::PARTIAL => 'Kısmi Ödeme',
            self::COMPLETED => 'Tamamlandı'
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING => 'danger',
            self::PARTIAL => 'warning',
            self::COMPLETED => 'success'
        };
    }
} 