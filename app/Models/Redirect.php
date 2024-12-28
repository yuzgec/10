<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Redirect extends Model
{
    protected $fillable = ['from_url', 'to_url', 'status_code', 'active'];

    protected static function boot()
    {
        parent::boot();
        
        // URL'lerin başındaki ve sonundaki slash'leri temizle
        static::saving(function ($model) {
            $model->from_url = trim($model->from_url, '/');
            $model->to_url = trim($model->to_url, '/');
        });
    }

    // Döngüsel yönlendirme kontrolü
    public function hasCircularRedirect(): bool
    {
        $visited = [$this->from_url];
        $current = $this->to_url;

        while ($next = self::where('from_url', $current)->where('active', true)->first()) {
            if (in_array($next->from_url, $visited)) {
                return true;
            }
            $visited[] = $next->from_url;
            $current = $next->to_url;
        }

        return false;
    }

    // Aktif yönlendirmeleri getir
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
} 