<?php

namespace App\View\Components\Dashboard\Icon;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Lock extends Component
{
 
    public function render(): View|Closure|string
    {
        return view('components.dashboard.icon.lock');
    }
}
