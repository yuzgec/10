<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductAttribute;
use Livewire\Features\SupportAttributes\AttributeCollection;

class ProductAttributeManager extends Component
{
    public array $selectedAttributes = [];
    public AttributeCollection $attributes;
    
    protected $listeners = ['refreshAttributes' => '$refresh'];
    
    public function boot()
    {
        $attributes = ProductAttribute::with(['translations', 'values.translations'])
            ->where('status', true)
            ->orderBy('rank')
            ->get();
            
        $this->attributes = new AttributeCollection($attributes->all());
    }
    
    public function mount(?Product $product = null)
    {
        $this->selectedAttributes = [];
        
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
        return view('livewire.product-attribute-manager', [
            'attributesList' => $this->attributes->keyBy('id')
        ]);
    }
} 