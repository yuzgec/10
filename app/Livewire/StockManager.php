<?php

namespace App\Livewire;

use Livewire\Component;

class StockManager extends Component
{
    public $manage_stock = true;
    public $min_stock_level;
    public $stock_status = 'in_stock';
    public $allow_backorders = false;
    public $notify_low_stock = true;
    public $low_stock_threshold;
    public $show_stock_quantity = true;

    public function mount($product = null)
    {
        if ($product) {
            $this->manage_stock = $product->manage_stock;
            $this->min_stock_level = $product->min_stock_level;
            $this->stock_status = $product->stock_status;
            $this->allow_backorders = $product->allow_backorders;
            $this->notify_low_stock = $product->notify_low_stock;
            $this->low_stock_threshold = $product->low_stock_threshold;
            $this->show_stock_quantity = $product->show_stock_quantity;
        }
    }

    public function updatedManageStock($value)
    {
        if (!$value) {
            $this->min_stock_level = null;
            $this->stock_status = 'in_stock';
            $this->allow_backorders = false;
            $this->notify_low_stock = false;
            $this->low_stock_threshold = null;
            $this->show_stock_quantity = false;
        }
    }

    public function updatedNotifyLowStock($value)
    {
        if (!$value) {
            $this->low_stock_threshold = null;
        }
    }

    public function render()
    {
        return view('livewire.stock-manager');
    }
} 