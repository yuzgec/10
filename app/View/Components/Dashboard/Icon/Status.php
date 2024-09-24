<?php

namespace App\View\Components\Dashboard\Icon;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Status extends Component
{
    
    public $status;

    public function __construct($status = 'green')
    {
     $this->status =  $status;   
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.icon.status');
    }
}
