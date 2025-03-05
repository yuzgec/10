<?php

namespace App\Enums;

enum ProductAttributeType: string
{
    case SELECT = 'select';
    case COLOR = 'color';
    case RADIO = 'radio';
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case CHECKBOX = 'checkbox';
    
    public function label(): string
    {
        return match($this) {
            self::SELECT => 'Seçim Kutusu',
            self::COLOR => 'Renk',
            self::RADIO => 'Radyo Buton',
            self::TEXT => 'Metin',
            self::TEXTAREA => 'Çok Satırlı Metin',
            self::CHECKBOX => 'Onay Kutusu'
        };
    }

    public function badge(): string
    {
        return match($this) {
            self::SELECT => 'bg-blue',
            self::COLOR => 'bg-purple',
            self::RADIO => 'bg-green',
            self::TEXT => 'bg-yellow',
            self::TEXTAREA => 'bg-pink',
            self::CHECKBOX => 'bg-red'
        };
    }
} 