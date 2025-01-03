<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class VariableProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'image' => 'required|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'featured' => 'boolean',
            'status' => 'boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:100',

            // Varyant validasyonları
            'variants' => 'required|array|min:1',
            'variants.*.name' => 'required|string|max:255',
            'variants.*.sku' => 'required|string|max:100|distinct|unique:product_variations,sku,' . ($this->product->id ?? ''),
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.discount_price' => 'nullable|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.attributes' => 'required|array',
            'variants.*.attributes.*' => 'required|exists:product_attribute_values,id',
        ];

        // Çoklu dil validasyonları
        foreach (config('app.locales') as $locale) {
            $rules["name:$locale"] = 'required|string|max:255';
            $rules["short:$locale"] = 'nullable|string|max:1000';
            $rules["desc:$locale"] = 'nullable|string|max:50000';
            $rules["purchase_note:$locale"] = 'nullable|string|max:1000';
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'image' => 'Ürün görseli',
            'gallery.*' => 'Galeri görseli',
            'featured' => 'Öne çıkan',
            'status' => 'Durum',
            'categories' => 'Kategoriler',
            'tags' => 'Etiketler',
            'variants' => 'Varyantlar',
            'variants.*.name' => 'Varyant adı',
            'variants.*.sku' => 'Varyant SKU',
            'variants.*.price' => 'Varyant fiyatı',
            'variants.*.discount_price' => 'Varyant indirimli fiyatı',
            'variants.*.stock' => 'Varyant stok',
            'variants.*.attributes' => 'Varyant özellikleri',
        ];

        // Çoklu dil attribute isimleri
        foreach (config('app.locales') as $locale) {
            $attributes["name:$locale"] = "Ürün adı ($locale)";
            $attributes["short:$locale"] = "Kısa açıklama ($locale)";
            $attributes["desc:$locale"] = "Detaylı açıklama ($locale)";
            $attributes["purchase_note:$locale"] = "Satın alma notu ($locale)";
        }

        return $attributes;
    }

    public function messages()
    {
        return [
            'image.required' => 'Lütfen bir ürün görseli seçin',
            'variants.required' => 'En az bir varyant eklemelisiniz',
            'variants.*.sku.unique' => 'Bu SKU kodu zaten kullanılmış',
            'variants.*.price.required' => 'Lütfen varyant fiyatını girin',
            'variants.*.stock.required' => 'Lütfen varyant stok miktarını girin',
            'variants.*.attributes.required' => 'Lütfen varyant özelliklerini seçin',
        ];
    }
} 