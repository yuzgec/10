<?php

namespace App\Livewire;

use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Livewire\Component;

class ProductAttributeManager extends Component
{
    public $selectedAttributes = [];
    public $attributes;

    public function mount($product = null)
    {
        $this->attributes = ProductAttribute::with('values')->where('status', true)->get();
        
        if ($product) {
            $this->selectedAttributes = $product->productAttributes()
                ->pluck('value_id', 'attribute_id')
                ->toArray();
        }
    }

    public function addAttribute($attributeId)
    {
        if (!isset($this->selectedAttributes[$attributeId])) {
            $this->selectedAttributes[$attributeId] = '';
        }
    }

    public function removeAttribute($attributeId)
    {
        unset($this->selectedAttributes[$attributeId]);
    }

    public function render()
    {
        return view('livewire.product-attribute-manager');
    }
} 