<?php

namespace App\View\Components\Dashboard\Site;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Seo extends Component
{


    public $title = '';
    public $limit = 200;
    public $lang;

    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.site.seo');
    }
}
