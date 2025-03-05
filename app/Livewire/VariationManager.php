<?php

namespace App\Livewire;

use App\Models\Shop\Attr;
use App\Models\Shop\Product;
use App\Models\Shop\Variation;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;

class VariationManager extends Component
{
    public $product;
    public $selectedAttributes = [];
    public $combinations = [];
    public $variations = [];
    public $show = false; // Varyasyon alanlarının görünürlüğünü kontrol eden değişken
    public $skuPrefix = ''; // SKU öneki

    public function mount(Product $product)
    {
        $this->product = $product;
        // Ürün varyasyonlu ise veya düzenleme sayfasındaysa göster
        $this->show = $product->isVariable() || $product->exists;
        $this->loadExistingVariations();
        
        // Eğer hiç özellik yoksa, başlangıçta bir tane ekle
        if (empty($this->selectedAttributes)) {
            $this->addAttribute();
        }
    }

    protected function loadExistingVariations()
    {
        if ($this->product->exists) {
            $variations = $this->product->variations()->with(['attributes', 'attributes.values'])->get();
            
            if ($variations->isNotEmpty()) {
                foreach ($variations as $variation) {
                    $varData = [
                        'id' => $variation->id,
                        'sku' => $variation->sku,
                        'price' => $variation->price,
                        'stock' => $variation->stock,
                        'attributes' => []
                    ];
                    
                    foreach ($variation->attributes as $attr) {
                        $varData['attributes'][$attr->id] = $attr->pivot->attr_value_id;
                    }
                    
                    $this->variations[] = $varData;
                }
                
                // Mevcut varyasyonlardan hangi özelliklerin seçili olduğunu belirle
                $firstVariation = $variations->first();
                if ($firstVariation) {
                    foreach ($firstVariation->attributes as $attr) {
                        $this->selectedAttributes[] = $attr->id;
                    }
                }
            }
        }
    }

    public function generateCombinations()
    {
        $this->combinations = [];
        
        if (empty($this->selectedAttributes)) {
            return;
        }
        
        try {
            $attributeValues = [];
            
            foreach ($this->selectedAttributes as $attrData) {
                if (empty($attrData['id']) || empty($attrData['selected'])) {
                    continue;
                }
                
                $attrId = $attrData['id'];
                $selectedValues = $attrData['selected'];
                
                if (!empty($selectedValues)) {
                    $attributeValues[$attrId] = is_array($selectedValues) ? $selectedValues : [$selectedValues];
                }
            }
            
            if (empty($attributeValues)) {
                return;
            }
            
            $this->combinations = $this->generateAllCombinations($attributeValues);
            
            // Mevcut varyasyonların değerlerini koru
            foreach ($this->combinations as $index => $combination) {
                foreach ($this->variations as $variation) {
                    $matchFound = true;
                    foreach ($combination['attributes'] as $attrId => $valueId) {
                        if (!isset($variation['attributes'][$attrId]) || $variation['attributes'][$attrId] != $valueId) {
                            $matchFound = false;
                            break;
                        }
                    }
                    
                    if ($matchFound) {
                        $this->combinations[$index]['id'] = $variation['id'];
                        $this->combinations[$index]['sku'] = $variation['sku'];
                        $this->combinations[$index]['price'] = $variation['price'];
                        $this->combinations[$index]['stock'] = $variation['stock'];
                        break;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Varyasyon kombinasyonu oluşturma hatası: ' . $e->getMessage());
        }
    }

    protected function generateAllCombinations($arrays, $i = 0) 
    {
        if (!isset(array_keys($arrays)[$i])) {
            return [];
        }
        
        if ($i == count($arrays) - 1) {
            $result = [];
            $attrId = array_keys($arrays)[$i];
            
            foreach ($arrays[$attrId] as $v) {
                $result[] = [
                    'attributes' => [$attrId => $v],
                    'id' => null,
                    'sku' => '',
                    'price' => $this->product->price ?? 0,
                    'stock' => $this->product->stock ?? 0
                ];
            }
            
            return $result;
        }
        
        $result = [];
        $attrId = array_keys($arrays)[$i];
        
        foreach ($arrays[$attrId] as $v) {
            $tmp = $this->generateAllCombinations($arrays, $i + 1);
            
            foreach ($tmp as $t) {
                $t['attributes'][$attrId] = $v;
                $result[] = $t;
            }
        }
        
        return $result;
    }

    public function saveVariations()
    {
        DB::beginTransaction();
        
        try {
            // Önce mevcut varyasyonları temizle
            $existingVariations = Variation::where('product_id', $this->product->id)->get();
            $savedVariationIds = [];
            
            foreach ($this->combinations as $combination) {
                $data = [
                    'product_id' => $this->product->id,
                    'sku' => $combination['sku'],
                    'price' => $combination['price'],
                    'stock' => $combination['stock']
                ];
                
                if (isset($combination['id']) && $combination['id']) {
                    // Var olan varyasyonu güncelle
                    $variation = Variation::find($combination['id']);
                    if ($variation) {
                        $variation->update($data);
                        $savedVariationIds[] = $variation->id;
                        
                        // Özellik bağlantılarını güncelle
                        $variation->attributes()->detach();
                        foreach ($combination['attributes'] as $attrId => $valueId) {
                            $variation->attributes()->attach($attrId, ['attr_value_id' => $valueId]);
                        }
                    }
                } else {
                    // Yeni varyasyon oluştur
                    $variation = Variation::create($data);
                    $savedVariationIds[] = $variation->id;
                    
                    // Özellikleri ekle
                    foreach ($combination['attributes'] as $attrId => $valueId) {
                        $variation->attributes()->attach($attrId, ['attr_value_id' => $valueId]);
                    }
                }
            }
            
            // Kaydedilmeyen varyasyonları sil
            foreach ($existingVariations as $existingVariation) {
                if (!in_array($existingVariation->id, $savedVariationIds)) {
                    $existingVariation->delete();
                }
            }
            
            DB::commit();
            session()->flash('success', 'Varyasyonlar başarıyla kaydedildi.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Varyasyon kaydetme hatası: ' . $e->getMessage());
            session()->flash('error', 'Varyasyon kaydedilirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $attributes = Attr::with('values')->get();
        return view('livewire.variation-manager', [
            'attributes' => $attributes,
            'productAttributes' => $attributes
        ]);
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
        if (isset($this->selectedAttributes[$index])) {
        unset($this->selectedAttributes[$index]);
        $this->selectedAttributes = array_values($this->selectedAttributes);
            $this->generateCombinations();
        }
    }

    public function loadAttributeValues($index)
    {
        if (isset($this->selectedAttributes[$index]['id']) && !empty($this->selectedAttributes[$index]['id'])) {
            $attrId = $this->selectedAttributes[$index]['id'];
            $attribute = Attr::with('values')->find($attrId);
            
            if ($attribute && $attribute->values->isNotEmpty()) {
                $this->selectedAttributes[$index]['values'] = $attribute->values;
                $this->selectedAttributes[$index]['selected'] = [];
            } else {
                $this->selectedAttributes[$index]['values'] = [];
            $this->selectedAttributes[$index]['selected'] = [];
            }
        }
    }

    #[On('productTypeChanged')]
    public function handleProductTypeChange($type)
    {
        if (is_array($type) && isset($type['type'])) {
            $this->show = $type['type'] === '2';
        } else {
            $this->show = $type === '2';
        }
        
        // Eğer varyasyonlu ürün seçildiyse ve hiç özellik yoksa, bir tane ekle
        if ($this->show && empty($this->selectedAttributes)) {
            $this->addAttribute();
        }
    }

    public function generateSKUs()
    {
        if (empty($this->skuPrefix)) {
            session()->flash('error', 'Lütfen bir SKU öneki girin.');
            return;
        }
        
        if (empty($this->combinations)) {
            session()->flash('error', 'Önce kombinasyonları oluşturmalısınız.');
            return;
        }

        foreach ($this->combinations as $index => $combination) {
            $attributeValues = [];
            
            foreach ($combination['attributes'] as $attrId => $valueId) {
                $value = \App\Models\Shop\AttrValue::find($valueId);
                if ($value) {
                    // Özellik değerinin ilk harfini al
                    $attributeValues[] = substr($value->getTranslation('name', app()->getLocale()), 0, 1);
                }
            }
            
            // SKU formatı: PREFIX-ATTR1-ATTR2-INDEX
            $this->combinations[$index]['sku'] = strtoupper($this->skuPrefix) . '-' . 
                                               implode('-', $attributeValues) . '-' . 
                                               ($index + 1);
        }
        
        session()->flash('success', 'SKU\'lar başarıyla oluşturuldu.');
    }
}