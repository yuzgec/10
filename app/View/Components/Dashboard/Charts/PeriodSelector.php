<?php

namespace App\View\Components\Dashboard\Charts;

use Illuminate\View\Component;

class PeriodSelector extends Component
{
    public string $currentPeriod;

    public function __construct($currentPeriod)
    {
        $this->currentPeriod = $currentPeriod;
    }

    public function render()
    {
        return view('components.dashboard.charts.period-selector', [
            'currentPeriod' => $this->currentPeriod
        ]);
    }
}
