<?php

namespace App\Models;

use Spatie\Tags\Tag as BaseTag;
use Illuminate\Support\Collection;

class Tag extends BaseTag
{
    public static function getTypes(): Collection
    {
        return collect([
            'product',
            'blog'
        ]);
    }
} 