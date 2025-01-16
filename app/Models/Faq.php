<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Faq extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    protected $table = 'faq';
    protected $guarded = [];
    public $timestamps = false;

    public $translatedAttributes = ['name','desc'];


    public function faqable()
    {
        return $this->morphTo();
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    } 

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function scopeLang($query){
        return $query->whereHas('translations', function ($query) {
            $query->where('locale', app()->getLocale());
        });
    }

    public function scopeRank($query){
        return $query->orderBy('rank','asc');
    }

    protected $casts = [
        'status' => StatusEnum::class,
    ];

    public function services()
    {
        return $this->morphedByMany(Service::class, 'faqable');
    }
}
