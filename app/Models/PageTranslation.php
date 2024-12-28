<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PageTranslation extends Model
{
    use HasFactory,HasSlug,LogsActivity;

    public $timestamps = false;
    protected $guarded = [];

    protected $translationForeignKey = 'page_id';
    
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug', 'short', 'desc'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => match($eventName) {
                'created' => 'Yeni kayıt oluşturuldu',
                'updated' => 'Kayıt güncellendi',
                'deleted' => 'Kayıt silindi',
                default => $eventName
            })
            ->useLogName('page_translation')
            ->logFillable()
            ->logExcept(['updated_at'])
            ->dontLogIfAttributesChangedOnly(['updated_at']);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);
        });

        static::updating(function ($model) {
            activity()
                ->causedBy(auth()->user())
                ->withProperties([
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent()
                ]);
        });
    }
}