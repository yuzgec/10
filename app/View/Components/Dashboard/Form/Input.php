<?php

namespace App\View\Components\Dashboard\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $name;
    public $class;
    public $column;
    public $id;
    public $disabled;
    public $placeholder;
    public $maxlength;
    public $icon;
    public $required;

    public function __construct($label, $name, $class = "form-control",$column=3, $id=null, $disabled = false, $placeholder = null,$maxlength = null, $icon=null, $required = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
        $this->column = $column;
        $this->id = $id;
        $this->disabled = $disabled;
        $this->placeholder = $placeholder;
        $this->maxlength = $maxlength;
        $this->icon = $icon;
        $this->required = $required;
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.form.input');
    }
}
