<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use App\Enums\MediumEnum;
use App\Enums\CustomerEnum;
use App\Models\CustomerOffer;
use App\Services\MediaService;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use App\Enums\CustomerOfferStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model implements HasMedia
{
    use HasFactory,LogsActivity,InteractsWithMedia,HasTags,SoftDeletes;

    protected $table = 'customers';
    protected $guarded = [];

    public function offers()
    {
        return $this->hasMany(CustomerOffer::class);
    }

    public function works()
    {
        return $this->hasMany(CustomerWork::class);
    }


    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['company_name', 'email', 'phone1', 'phone2', 'staff_name', 'authorized_person']);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'plate_no');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        MediaService::registerMediaCollections($this);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        MediaService::registerMediaConversions($this, $media, false);
    }
    protected $casts = [
        'status' => CustomerEnum::class,
        'medium' => MediumEnum::class,
    ];



}
