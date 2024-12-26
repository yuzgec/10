<?php

namespace App\View\Components\Dashboard\Charts;

use App\Services\ViewService;
use Illuminate\View\Component;

class ViewStats extends Component
{
    public array $chartData;
    public string $title;
    public string $currentPeriod;

    public function __construct(
        public string $model,
        string $title = 'En Çok Bakılan Sayfalar',
        ?int $categoryId = null,
        int $limit = 10
    ) {
        $viewService = app(ViewService::class);
        $this->currentPeriod = request('period', ViewService::PERIOD_ALL);
        $this->title = $title;
        
        $modelClass = $this->model;
        
        $this->chartData = $viewService->getViewStats(
            $modelClass,
            $this->currentPeriod,
            $categoryId,
            $limit
        );
    }

    public function render()
    {
        return view('components.dashboard.charts.view-stats');
    }
} 