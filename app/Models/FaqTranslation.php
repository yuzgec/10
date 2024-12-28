<?php

namespace App\Models;

use App\Traits\LogsActivityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FaqTranslation extends Model
{
    use LogsActivityTrait,HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    protected $translationForeignKey = 'faq_id';

    protected $logAttributes = ['name'];
    public function getCustomAttributeNames()
    {
        return [ 'name' => 'Başlık'];
    }


  
}
