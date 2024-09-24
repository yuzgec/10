<?php

namespace App\View\Components\Dashboard\Site;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotFound extends Component
{
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.site.not-found');
    }
}
