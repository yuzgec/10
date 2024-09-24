<?php

namespace App\Models;


use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogTranslation extends Model implements Viewable
{
    use HasFactory,HasSlug,LogsActivity,InteractsWithViews;

    public $timestamps = false;
    protected $guarded = [];

    protected $translationForeignKey = 'blog_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'slug'])
            ->setDescriptionForEvent(function(string $eventName) {
                $model = __('models.' . class_basename($this));
                $attributes = $this->getChanges();

                $attributeNames = collect($attributes)
                    ->keys()
                    ->map(fn ($key) => __('activity.' . $key))
                    ->implode(', ');

                return __('activity.' . $eventName, [
                    'user' => auth()->user()->name ?? 1,
                    'model' => $model,
                    'attribute' => $attributeNames,
                ]);
            });
    }

    /**
     * Bu model ile ilişkili activity log kayıtlarını getirir.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function activities()
    {
        return Activity::where('subject_type', self::class)
            ->where('subject_id', $this->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
    
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->allowDuplicateSlugs();

    }

}