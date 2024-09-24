<?php

namespace App\View\Components\Dashboard\Site;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Activities extends Component
{
    /**
     * Create a new component instance.
     */

    public $activities;

    public function __construct($activities)
    {
        $this->activities = $activities;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.site.activities');
    }
}
