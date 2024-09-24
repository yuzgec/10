<?php


namespace App\Enums;


enum SettingsEnum : int {
    case FILE           = 1;
    case INPUT          = 2;
    case TEXTAREA       = 3;
    case CHECKBOX       = 4;


    public function title(){
        return match ($this) {
             self::FILE         => 'Dosya',
             self::INPUT        => 'Input',
             self::TEXTAREA     => 'TextArea',
             self::CHECKBOX     => 'CheckBox',
        };
    }
}