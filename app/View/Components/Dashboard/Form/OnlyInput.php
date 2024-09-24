<?php

namespace App\View\Components\dashboard\form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OnlyInput extends Component
{
    public $name;
    public $class;
    public $id;
    public $disabled;
    public $placeholder;
    public $maxlength;

    public function __construct($name, $class = "form-control", $id=null, $disabled = false, $placeholder = null, $maxlength=250)
    {
        $this->name = $name;
        $this->class = $class;
        $this->id = $id;
        $this->disabled = $disabled;
        $this->placeholder = $placeholder;
        $this->maxlength = $maxlength;
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.form.only-input');
    }
}
