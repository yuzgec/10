<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    protected $translationForeignKey = 'faq_id';

  
}
