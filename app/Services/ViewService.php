<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Team;
use App\Models\Video;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Support\Period;

class ViewService
{
    const PERIOD_DAY = 'day';
    const PERIOD_WEEK = 'week';
    const PERIOD_MONTH = 'month';
    const PERIOD_YEAR = 'year';
    const PERIOD_ALL = 'all';

    public function getViewStats(
        string $model,
        string $periodType = self::PERIOD_ALL,
        ?int $categoryId = null,
        int $limit = 10
    ): array {
        try {
            $period = $this->calculatePeriod($periodType);
            
            $query = $model::query();

            if ($period) {
                $query->orderByViews('desc', $period);
            } else {
                $query->orderByViews('desc');
            }

            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }

            $topItems = $query->take($limit)->get();

            return [
                'labels' => $topItems->pluck('name')->toArray(),
                'views' => $topItems->pluck('views_count')->toArray(),
                'period' => $this->getPeriodLabel($periodType),
                'total' => $topItems->sum('views_count')
            ];
        } catch (\Exception $e) {
            \Log::error('ViewStats Error: ' . $e->getMessage());
            return [
                'labels' => [],
                'views' => [],
                'period' => $this->getPeriodLabel($periodType),
                'total' => 0
            ];
        }
    }

    private function calculatePeriod(string $periodType): ?Period
    {
        if ($periodType === self::PERIOD_ALL) {
            return null;
        }

        $now = Carbon::now();
        
        return match ($periodType) {
            self::PERIOD_DAY => Period::create($now->copy()->startOfDay(), $now),
            self::PERIOD_WEEK => Period::create($now->copy()->startOfWeek(), $now),
            self::PERIOD_MONTH => Period::create($now->copy()->startOfMonth(), $now),
            self::PERIOD_YEAR => Period::create($now->copy()->startOfYear(), $now),
            default => null,
        };
    }

    private function getPeriodLabel(string $periodType): string
    {
        return match ($periodType) {
            self::PERIOD_DAY => 'Bugün',
            self::PERIOD_WEEK => 'Bu Hafta',
            self::PERIOD_MONTH => 'Bu Ay',
            self::PERIOD_YEAR => 'Bu Yıl',
            default => 'Tüm Zamanlar',
        };
    }

    public function getMostViewedPages(int $limit = 10): Collection
    {
        // Tüm modelleri bir array'de toplayın
        $models = collect([
            Blog::class,
            Service::class,
            Page::class,
            Team::class,
            Category::class,
            Video::class,
            // ... diğer modeller
        ]);

        $allViews = collect();

        foreach ($models as $model) {
            $views = $model::orderByViews('desc')
                ->with('views')
                ->get()
                ->map(function ($item) {
                    return [
                        'name' => $this->getModelName($item),
                        'url' => $this->getModelUrl($item),
                        'views' => $item->views_count,
                        'percentage' => 0,
                        'model_type' => class_basename($item)
                    ];
                });

            $allViews = $allViews->concat($views);
        }

        // Görüntülenme sayısına göre sırala
        $allViews = $allViews->sortByDesc('views');

        // En yüksek görüntülenme sayısını bul
        $maxViews = $allViews->max('views');

        // Yüzdeleri hesapla
        $allViews = $allViews->map(function ($item) use ($maxViews) {
            if ($maxViews > 0 && isset($item['views'])) {
                $item['percentage'] = ($item['views'] / $maxViews) * 100;
            }
            return $item;
        });

        return $allViews->take($limit);
    }

    private function getModelName($model)
    {
        if (method_exists($model, 'getTranslation')) {
            return $model->getTranslation('name', app()->getLocale());
        }
        
        if (isset($model->name)) {
            return $model->name;
        }
        
        if (isset($model->title)) {
            return $model->title;
        }
        
        return 'Unnamed';
    }

    private function getModelUrl($model)
    {
        if (method_exists($model, 'getTranslation')) {
            return $model->getTranslation('slug', app()->getLocale());
        }
        
        if (isset($model->slug)) {
            return $model->slug;
        }
        
        return '#';
    }
} 