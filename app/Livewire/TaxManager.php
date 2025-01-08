<?php

namespace App\Livewire;

use App\Models\TaxClass;
use Livewire\Component;

class TaxManager extends Component
{
    public $taxStatus = 'none';
    public $taxClassId = '';
    public $showTaxClass = false;
    public $taxClasses;

    public function mount($taxStatus = 'none', $taxClassId = null)
    {
        $this->taxStatus = $taxStatus;
        $this->taxClassId = $taxClassId;
        $this->showTaxClass = $taxStatus === 'taxable';
        $this->loadTaxClasses();
    }

    public function loadTaxClasses()
    {
        $this->taxClasses = TaxClass::orderBy('name')->get();
    }

    public function updatedTaxStatus($value)
    {
        $this->showTaxClass = $value === 'taxable';
        if ($value === 'none') {
            $this->taxClassId = '';
        }
    }

    public function render()
    {
        return view('livewire.tax-manager');
    }
} 