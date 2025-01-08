<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;

class BrandManager extends Component
{
    public $selectedBrandId = '';
    public $newBrandName = '';
    public $brands;
    public $showAddBrand = true;
    
    protected $listeners = ['brandCreated'];

    protected $messages = [
        'newBrandName.required' => 'Marka adı gereklidir.',
        'newBrandName.min' => 'Marka adı en az 2 karakter olmalıdır.',
        'newBrandName.max' => 'Marka adı en fazla 50 karakter olmalıdır.',
        'newBrandName.unique' => 'Bu marka daha önce eklenmiş.'
    ];

    public function mount($selectedId = null)
    {
        $this->selectedBrandId = $selectedId;
        $this->loadBrands();
        $this->showAddBrand = empty($selectedId);
    }

    public function loadBrands()
    {
        $this->brands = Brand::orderBy('name')->get();
    }

    public function createBrand()
    {
        $this->validate([
            'newBrandName' => 'required|min:2|max:50|unique:brands,name'
        ]);

        $brand = Brand::create([
            'name' => $this->newBrandName,
            'slug' => Str::slug($this->newBrandName)
        ]);

        $this->loadBrands();
        $this->selectedBrandId = $brand->id;
        $this->newBrandName = '';
        $this->showAddBrand = false;
        
        $this->dispatch('brandCreated', [
            'brandId' => $brand->id
        ]);
    }

    public function render()
    {
        return view('livewire.brand-manager');
    }
} 