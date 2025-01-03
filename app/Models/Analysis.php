<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Analysis extends Model
{
    use HasFactory;

    protected $table = 'analysis';
    protected $guarded = [];
  
}
