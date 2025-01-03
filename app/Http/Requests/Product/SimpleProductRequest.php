<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SimpleProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'sku' => 'required|string|max:100|unique:products,sku,' . ($this->product->id ?? ''),
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'featured' => 'boolean',
            'status' => 'boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:100',
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
            'sku' => 'SKU',
            'price' => 'Fiyat',
            'discount_price' => 'İndirimli fiyat',
            'stock' => 'Stok',
            'featured' => 'Öne çıkan',
            'status' => 'Durum',
            'categories' => 'Kategoriler',
            'tags' => 'Etiketler',
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
            'sku.unique' => 'Bu SKU kodu zaten kullanılmış',
            'price.required' => 'Lütfen ürün fiyatını girin',
            'discount_price.lt' => 'İndirimli fiyat normal fiyattan düşük olmalıdır',
            'stock.required' => 'Lütfen stok miktarını girin',
        ];
    }
} 