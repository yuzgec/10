<?php

namespace App\View\Components\Dashboard\Site;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotTrash extends Component
{
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.dashboard.site.not-trash');
    }
}
