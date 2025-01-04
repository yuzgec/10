<?php

namespace App\Enums;

enum ProductAttributeType: string
{
    case SELECT = 'select';
    case COLOR = 'color';
    case BUTTON = 'button';

    public function label(): string
    {
        return match($this) {
            self::SELECT => 'Seçim Kutusu',
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