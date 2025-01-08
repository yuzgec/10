<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class District extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
