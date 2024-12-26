<?php

namespace App\Services;

use Carbon\Carbon;
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
} 