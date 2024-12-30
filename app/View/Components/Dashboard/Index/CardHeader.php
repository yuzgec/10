<?php

namespace App\View\Components\Dashboard\Index;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $all;

    public function __construct($all = null)
    {
        $this->all = $all;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.index.card-header');
    }
}
