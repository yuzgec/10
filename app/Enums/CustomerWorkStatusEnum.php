<?php

namespace App\Enums;

enum CustomerWorkStatusEnum: int
{
    case PENDING = 1;
    case IN_PROGRESS = 2;
    case COMPLETED = 3;
    case CANCELLED = 4;

    public function title(): string
    {
        return match($this) {
            self::PENDING => 'Bekliyor',
            self::IN_PROGRESS => 'Devam Ediyor',
            self::COMPLETED => 'Tamamlandı',
            self::CANCELLED => 'İptal Edildi'
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING => 'warning',
            self::IN_PROGRESS => 'info',
            self::COMPLETED => 'success',
            self::CANCELLED => 'danger'
        };
    }
}