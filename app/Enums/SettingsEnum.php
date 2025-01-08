<?php

namespace App\Enums;

enum SettingsEnum : int {
    case FILE           = 1;
    case INPUT          = 2;
    case TEXTAREA       = 3;
    case CHECKBOX       = 4;
    case PASSWORD       = 5;
    case HIDDEN         = 6;
    case BOOLEAN        = 7;

    public function title(){
        return match ($this) {
             self::FILE         => 'Dosya',
             self::INPUT        => 'Input',
             self::TEXTAREA     => 'TextArea',
             self::CHECKBOX     => 'CheckBox',
             self::PASSWORD     => 'Parola',
             self::HIDDEN       => 'Gizli',
             self::BOOLEAN      => 'Aç-Kapa',
        };
    }
}