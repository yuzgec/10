<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerWorkType extends Model
{
    use HasFactory;

    protected $table = 'customer_work_types';
    protected $guarded = [];
    public $timestamps = false;
    
}
