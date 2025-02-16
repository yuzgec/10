<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Traits\LogsActivityTrait;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamTranslation extends Model
{
    use LogsActivityTrait,HasFactory,HasSlug;
    
    public $timestamps = false;
    protected $guarded = [];

    protected $translationForeignKey = 'team_id';
    protected $logAttributes = ['name', 'slug', 'facebook', 'twitter', 'linkedin', 'instagram', 'youtube'];

    // Özel alan isimleri
    public function getCustomAttributeNames()
    {
        return [ 'name' => 'Başlık', 'slug' => 'Link'];
    }


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


}

