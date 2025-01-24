<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductAttribute;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\WithFileUploads as LivewireWithFileUploads;

class VariationManager extends Component
{
    use LivewireWithFileUploads;
   

    public $productAttributes = [];
    public $selectedAttributes = [];
    public $variations = [];
    public $bulkPrice = '';
    public $skuPrefix = '';
    public $product;
    public $defaultVariation = null;
    public $variationPhotos = [];
    public $sortOrder = [];

    public function mount($product = null)
    {
        $this->product = $product;
        $this->loadAttributes();
        
        if ($product) {
            $this->loadExistingVariations();
        }
    }

    private function loadAttributes()
    {
        $this->productAttributes = ProductAttribute::with(['translations', 'values'])
            ->where('status', 1)
            ->orderBy('rank')
            ->get()
            ->map(function($attribute) {
                return [
                    'id' => $attribute->id,
                    'name' => $attribute->translate('tr')->name,
                    'type' => $attribute->type,
                    'values' => $attribute->values->map(function($value) {
                        return [
                            'id' => $value->id,
                            'name' => $value->translate('tr')->name
                        ];
                    })
                ];
            })->toArray();
    }

    private function loadExistingVariations()
    {
        $this->variations = $this->product->variations()
            ->with(['attributeValues.translations'])
            ->get()
            ->map(function($variation) {
                if ($variation->is_default) {
                    $this->defaultVariation = $variation->id;
                }
                return [
                    'id' => $variation->id,
                    'sku' => $variation->sku,
                    'price' => $variation->price,
                    'stock' => $variation->stock,
                    'is_default' => $variation->is_default,
                    'values' => $variation->attributeValues->map(function($value) {
                        return [
                            'attribute_id' => $value->attribute_id,
                            'value_id' => $value->id,
                            'name' => $value->translate('tr')->name
                        ];
                    })
                ];
            })->toArray();
    }

    public function addAttribute()
    {
        // Seçili özellik ID'lerini al
        $selectedAttributeIds = collect($this->selectedAttributes)
            ->pluck('id')
            ->filter()
            ->toArray();

        // Seçilebilir özellikleri filtrele
        $availableAttributes = collect($this->productAttributes)
            ->whereNotIn('id', $selectedAttributeIds);

        // Eklenebilecek özellik varsa ve aynı özellik daha önce eklenmemişse ekle
        if ($availableAttributes->isNotEmpty()) {
            $this->selectedAttributes[] = [
                'id' => '',
                'values' => [],
                'selected' => []
            ];
        }
    }

    public function removeAttribute($index)
    {
        array_splice($this->selectedAttributes, $index, 1);
        $this->generateVariations();
    }

    public function loadAttributeValues($index)
    {
        $attribute = $this->selectedAttributes[$index];
        if (!$attribute['id']) return;

        $attr = collect($this->productAttributes)->firstWhere('id', $attribute['id']);
        if ($attr) {
            $this->selectedAttributes[$index]['values'] = $attr['values'];
        }
    }

    public function generateVariations()
    {
        // Seçili değerleri kontrol et
        $hasSelectedValues = collect($this->selectedAttributes)->some(function($attr) {
            return !empty($attr['selected']);
        });

        if (!$hasSelectedValues) {
            $this->variations = [];
            return;
        }

        // Her özellik için seçili değerleri al
        $selectedValues = collect($this->selectedAttributes)->reduce(function($acc, $attr) {
            if (!empty($attr['selected'])) {
                $acc[$attr['id']] = $attr['selected'];
            }
            return $acc;
        }, []);

        // Kartezyen çarpım ile kombinasyonları oluştur
        $combinations = $this->cartesianProduct($selectedValues);

        // Mevcut varyasyonları koru
        $existingVariations = collect($this->variations)->keyBy(function($variation) {
            return $this->getVariationKey($variation['values']);
        });

        // Varyasyonları güncelle
        $this->variations = collect($combinations)->map(function($combination, $index) use ($existingVariations) {
            $values = collect($combination)->map(function($valueId, $attrId) {
                $attribute = collect($this->productAttributes)->firstWhere('id', $attrId);
                $value = collect($attribute['values'])->firstWhere('id', $valueId);
                
                return [
                    'attribute_id' => (int)$attrId,
                    'value_id' => $valueId,
                    'name' => $value['name']
                ];
            })->values()->all();

            $key = $this->getVariationKey($values);
            
            return $existingVariations->get($key, [
                'temp_id' => 'new_' . ($index + 1), // Geçici ID ekle
                'values' => $values,
                'sku' => '',
                'price' => '',
                'discount_price' => '',
                'stock' => 0,
                'is_default' => false
            ]);
        })->values()->all();
    }

    private function cartesianProduct($arrays) 
    {
        $result = [[]];
        foreach ($arrays as $key => $array) {
            $append = [];
            foreach ($result as $product) {
                foreach ($array as $item) {
                    $product[$key] = $item;
                    $append[] = $product;
                }
            }
            $result = $append;
        }
        return $result;
    }

    private function getVariationKey($values)
    {
        return collect($values)
            ->map(fn($v) => $v['attribute_id'] . '-' . $v['value_id'])
            ->sort()
            ->join('|');
    }

    public function applyBulkPrice()
    {
        if (!$this->bulkPrice) return;
        foreach ($this->variations as &$variation) {
            $variation['price'] = $this->bulkPrice;
        }
    }

    public function generateSKUs()
    {
        $prefix = strtoupper(trim($this->skuPrefix));
        foreach ($this->variations as &$variation) {
            $skuCode = collect($variation['values'])
                ->pluck('name')
                ->map(fn($name) => substr($name, 0, 1))
                ->join('');
            
            $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $variation['sku'] = $prefix ? "{$prefix}-{$skuCode}-{$random}" : "{$skuCode}-{$random}";
        }
    }

    public function updatedDefaultVariation($value)
    {
        foreach ($this->variations as $index => &$variation) {
            $variation['is_default'] = ($index == $value);
        }
    }

    public function updateVariationOrder($items)
    {
        $orderedVariations = collect($items)->map(function($item) {
            return collect($this->variations)->first(function($variation) use ($item) {
                $variationId = $variation['id'] ?? $variation['temp_id'];
                return $variationId == $item['value'];
            });
        })->filter()->values();

        $this->variations = $orderedVariations->toArray();
    }

    public function updatedVariationPhotos($photo, $key)
    {
        $index = explode('.', $key)[0];
        
        if (isset($this->variations[$index])) {
            try {
                $this->variations[$index]['photo'] = $photo;
                $this->variations[$index]['photo_preview'] = $photo->temporaryUrl();
            } catch (\Exception $e) {
                // Hata durumunda işlem yapma
            }
        }
    }

    public function render()
    {
        return view('livewire.variation-manager');
    }
} 