<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model implements TranslatableContract
{
    use HasFactory,SoftDeletes,Translatable;

    protected $table = 'faq';
    protected $guarded = [];

    public $translatedAttributes = ['name','desc'];


    public function faqable()
    {
        return $this->morphTo();
    }


    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    } 

    protected $casts = [
        'status' => StatusEnum::class,
    ];
}
