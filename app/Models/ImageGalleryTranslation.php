<?php

namespace App\Models;

use App\Traits\LogsActivityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageGalleryTranslation extends Model
{
    use LogsActivityTrait,HasFactory;

    protected $logAttributes = ['name', 'slug'];
    public function getCustomAttributeNames()
    {
        return [ 'name' => 'Başlık', 'slug' => 'Link'];
    }


    
}
