<?php

namespace App\Models;

use App\Enums\MediumEnum;
use App\Enums\CustomerEnum;
use App\Models\CustomerOffer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Customer extends Model implements HasMedia
{
    use HasFactory,LogsActivity,InteractsWithMedia;

    protected $table = 'customers';
    protected $guarded = [];

    public function offers(): HasMany
    {
        return $this->hasMany(CustomerOffer::class, 'customer_id', 'id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(CustomerWork::class, 'customer_id', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['company_name', 'email', 'phone1', 'phone2', 'staff_name', 'authorized_person']);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('page')
            ->useFallbackUrl('/backend/resimyok.jpg');

        $this->addMediaCollection('gallery')
            ->useFallbackUrl('/backend/resimyok.jpg');

    }

    public function registerMediaConversions(Media $media = null): void
    {
        if ($media === null) {
            return;
        }

        $this->addMediaConversion('img')
            ->width(1250)
            ->nonOptimized()
            ->keepOriginalImageFormat()
            ->performOnCollections('page', 'gallery');

        $this->addMediaConversion('thumb')
            ->width(500)
            ->nonOptimized()
            ->keepOriginalImageFormat()
            ->performOnCollections('page', 'gallery');
            
        $this->addMediaConversion('small')
            ->width(250)
            ->nonOptimized()
            ->keepOriginalImageFormat()
            ->performOnCollections('page', 'gallery');
                 
        $this->addMediaConversion('icon')
            ->width(100)
            ->nonOptimized()
            ->keepOriginalImageFormat()
            ->performOnCollections('page', 'gallery');
    }

    protected $casts = [
        'status' => CustomerEnum::class,
        'medium' => MediumEnum::class,
    ];


}
