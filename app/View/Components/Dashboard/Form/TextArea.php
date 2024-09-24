<?php

namespace App\View\Components\Dashboard\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    public $label;
    public $name;
    public $class;
    public $ck;


    public function __construct($label, $name, $class = "form-control", $ck = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
        $this->ck = $ck;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.dashboard.form.text-area');
    }
}
