<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Shop\Attribute;
use App\Models\Shop\AttributeValue;

class VariationManager extends Component
{
    public $selectedAttributes = [];
    public $variations = [];
    public $skuPrefix = '';
    public $productAttributes;
    public $show = false;

    protected $listeners = ['productTypeChanged'];

    public function mount()
    {
        $this->productAttributes = Attribute::with('values')->get();
        $this->addAttribute();
    }

    public function productTypeChanged($type)
    {
        $this->show = ($type == 2);
    }

    public function addAttribute()
    {
        $this->selectedAttributes[] = [
            'id' => '',
            'values' => [],
            'selected' => []
        ];
    }

    public function removeAttribute($index)
    {
        unset($this->selectedAttributes[$index]);
        $this->selectedAttributes = array_values($this->selectedAttributes);
        $this->generateVariations();
    }

    public function loadAttributeValues($index)
    {
        if (!isset($this->selectedAttributes[$index])) return;
        
        $attributeId = $this->selectedAttributes[$index]['id'];
        if ($attributeId) {
            $values = AttributeValue::where('attr_id', $attributeId)->get();
            $this->selectedAttributes[$index]['values'] = $values;
            $this->selectedAttributes[$index]['selected'] = [];
        }
    }

    public function updatedSelectedAttributes()
    {
        $this->generateVariations();
    }

    public function generateVariations()
    {
        // Seçili değerleri olan özellikleri filtrele
        $selectedValues = [];
        
        foreach ($this->selectedAttributes as $attribute) {
            if (!empty($attribute['id']) && !empty($attribute['selected'])) {
                $selectedValues[] = $attribute['selected'];
            }
        }

        // Hiç seçili özellik yoksa boş array döndür
        if (empty($selectedValues)) {
            $this->variations = [];
            return;
        }

        // Kartezyen çarpım fonksiyonu
        $cartesian = function($input) {
            $result = [[]];
            foreach ($input as $key => $values) {
                $append = [];
                foreach ($result as $product) {
                    foreach ($values as $item) {
                        $product[$key] = $item;
                        $append[] = $product;
                    }
                }
                $result = $append;
            }
            return $result;
        };

        // Varyasyonları oluştur
        $combinations = $cartesian($selectedValues);
        
        $this->variations = array_map(function($combination) {
            return [
                'values' => array_values($combination),
                'sku' => '',
                'price' => '',
                'stock' => '',
                'status' => true
            ];
        }, $combinations);
    }

    public function generateSKUs()
    {
        foreach ($this->variations as $index => $variation) {
            $this->variations[$index]['sku'] = $this->skuPrefix . '-' . implode('-', $variation['values']);
        }
    }

    public function render()
    {
        return view('livewire.variation-manager');
    }
}