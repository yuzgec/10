<?php

namespace App\Livewire;

use Livewire\Component;

class ShippingManager extends Component
{
    public $requires_shipping = true;
    public $delivery_time;

    public function mount($product = null)
    {
        if ($product) {
            $this->requires_shipping = $product->requires_shipping;
            $this->delivery_time = $product->delivery_time;
        }
    }

    public function updatedRequiresShipping($value)
    {
        if (!$value) {
            $this->delivery_time = null;
        }
    }

    public function render()
    {
        return view('livewire.shipping-manager');
    }
} 