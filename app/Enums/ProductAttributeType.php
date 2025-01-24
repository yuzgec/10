<?php

namespace App\Enums;

enum ProductAttributeType: int
{
    case SELECT     = 1;
    case COLOR      = 2;
    case BUTTON     = 3;

    public function label(): string
    {
        return match($this) {
            self::SELECT => 'Seçim',
            self::COLOR => 'Renk',
            self::BUTTON => 'Buton'
        };
    }

    public function badge(): string
    {
        return match($this) {
            self::SELECT => 'bg-blue',
            self::COLOR => 'bg-purple',
            self::BUTTON => 'bg-green'
        };
    }
} 