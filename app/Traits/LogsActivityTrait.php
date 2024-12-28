<?php

namespace App\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait LogsActivityTrait
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->logAttributes ?? ['name', 'slug'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => match($eventName) {
                'created' => 'Oluşturuldu',
                'updated' => 'Güncellendi',
                'deleted' => 'Silindi',
                default => $eventName
            })
            ->useLogName($this->getTable())
            ->logFillable();
    }

    public static function bootLogsActivityTrait()
    {
    static::created(function ($model) {
        activity()
            ->performedOn($model)
            ->causedBy(auth()->user())
            ->event('created')
            ->withProperties([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'attributes' => $model->getAttributes(),
                'old' => [],
                'model_type' => get_class($model) // Model sınıfını ekle
            ])
            ->log('Eklendi');
    });

    static::updated(function ($model) {
        activity()
            ->performedOn($model)
            ->causedBy(auth()->user())
            ->event('updated')
            ->withProperties([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'attributes' => $model->getAttributes(),
                'old' => $model->getOriginal(),
                'model_type' => get_class($model) // Model sınıfını ekle
            ])
            ->log('Güncellendi');
    });
}
}