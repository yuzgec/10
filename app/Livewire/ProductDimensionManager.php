<?php

namespace App\Livewire;

use Livewire\Component;

class ProductDimensionManager extends Component
{
    public $weight;
    public $length;
    public $width; 
    public $height;
    public $dimension_unit = null;
    public $volume = 0;
    
    protected $listeners = ['dimensionUpdated' => '$refresh'];

    public function mount($product = null)
    {
        if ($product) {
            $this->weight = $product->weight;
            $this->length = $product->length;
            $this->width = $product->width;
            $this->height = $product->height;
            $this->dimension_unit = $product->dimension_unit;
            $this->calculateVolume();
        }
    }

    public function updatedLength()
    {
        $this->checkAndSetDimensionUnit();
        $this->calculateVolume();
    }

    public function updatedWidth()
    {
        $this->checkAndSetDimensionUnit();
        $this->calculateVolume();
    }

    public function updatedHeight()
    {
        $this->checkAndSetDimensionUnit();
        $this->calculateVolume();
    }

    private function checkAndSetDimensionUnit()
    {
        if (($this->length || $this->width || $this->height) && !$this->dimension_unit) {
            $this->dimension_unit = 'cm';
        } elseif (!$this->length && !$this->width && !$this->height) {
            $this->dimension_unit = null;
        }
    }

    public function calculateVolume()
    {
        if ($this->length && $this->width && $this->height) {
            $length = $this->convertToCm($this->length, $this->dimension_unit);
            $width = $this->convertToCm($this->width, $this->dimension_unit);
            $height = $this->convertToCm($this->height, $this->dimension_unit);
            
            $this->volume = round(($length * $width * $height) / 1000, 2);
        } else {
            $this->volume = 0;
        }
    }

    private function convertToCm($value, $unit)
    {
        if (!$value) return 0;
        
        return match($unit) {
            'mm' => $value / 10,
            'm' => $value * 100,
            default => $value, // cm
        };
    }

    public function render()
    {
        return view('livewire.product-dimension-manager');
    }
}