<?php

namespace App\Models;

use App\Enums\SettingsEnum;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory,LogsActivity;

    protected $table = 'settings';
    protected $guarded = [];
    public $timestamps = false;
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['item', 'value']);
    }

    protected $casts = [
        'isType' => SettingsEnum::class,
    ];

}
