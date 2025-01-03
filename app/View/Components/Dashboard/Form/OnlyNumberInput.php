<?php

namespace App\View\Components\Dashboard\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OnlyNumberInput extends Component
{
    public $name;
    public $class;
    public $id;
    public $disabled;
    public $placeholder;
    public $maxlength;
    public $icon;

    public function __construct($name, $class = "form-control", $id=null, $disabled = false, $placeholder = null, $maxlength=250, $icon=null)
    {
        $this->name = $name;
        $this->class = $class;
        $this->id = $id;
        $this->disabled = $disabled;
        $this->placeholder = $placeholder;
        $this->maxlength = $maxlength;
        $this->icon = $icon;
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.form.only-number-input');
    }
}
