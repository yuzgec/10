<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class RelationProduct extends Component
{
    public $selectedProducts = [];
    public $products = [];
    public $product;

    public function mount($product = null)
    {
        $this->product = $product;
        if ($product) {
            $this->selectedProducts = $product->relatedProducts->pluck('id')->toArray();
        }
    }

    public function updateSelectedProducts($selectedProducts)
    {
        $this->selectedProducts = json_decode($selectedProducts);
    }

    public function render()
    {
        return view('livewire.relation-product');
    }
} 