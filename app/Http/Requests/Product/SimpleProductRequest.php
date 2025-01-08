<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SimpleProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'sku' => 'required|string|max:255|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'featured' => 'boolean',
            'status' => 'boolean',
            'categories' => 'required|array',
            'categories.*' => 'exists:product_categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'brand_id' => 'nullable|exists:brands,id',
            'tax_status' => 'required|in:taxable,none',
            'tax_class_id' => 'nullable|required_if:tax_status,taxable|exists:tax_classes,id',
            'selectedAttributes' => 'nullable|array',
            'selectedAttributes.*' => 'nullable|exists:product_attribute_values,id'
        ];

        // Dil alanları için kurallar
        foreach (config('app.languages', ['tr']) as $lang) {
            $rules["name:$lang"] = 'required|string|max:255';
            $rules["slug:$lang"] = 'nullable|string|max:255';
            $rules["description:$lang"] = 'nullable|string';
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
            'stock' => 'Stok',
            'featured' => 'Öne çıkan',
            'status' => 'Durum',
            'categories' => 'Kategoriler',
            'tags' => 'Etiketler',
            'brand_id' => 'Marka',
            'tax_status' => 'Vergi durumu',
            'tax_class_id' => 'Vergi sınıfı',
            'selectedAttributes' => 'Özellikler',
            'selectedAttributes.*' => 'Özellik değeri'
        ];

        // Dil alanları için özel isimler
        foreach (config('app.languages', ['tr']) as $lang) {
            $attributes["name:$lang"] = "Ürün adı ($lang)";
            $attributes["description:$lang"] = "Açıklama ($lang)";
        }

        return $attributes;
    }

    public function messages()
    {
        $messages = [
            'sku.required' => 'SKU alanı zorunludur',
            'sku.unique' => 'Bu SKU kodu zaten kullanılmış',
            'price.required' => 'Fiyat alanı zorunludur',
            'price.numeric' => 'Fiyat sayısal bir değer olmalıdır',
            'price.min' => 'Fiyat 0\'dan büyük olmalıdır',
            'stock.required' => 'Stok alanı zorunludur',
            'stock.integer' => 'Stok tam sayı olmalıdır',
            'stock.min' => 'Stok 0\'dan büyük olmalıdır',
            'categories.required' => 'En az bir kategori seçmelisiniz',
        ];

        // Dil alanları için özel mesajlar
        foreach (config('app.languages', ['tr']) as $lang) {
            $messages["name:$lang.required"] = "$lang dilinde ürün adı zorunludur";
            $messages["name:$lang.string"] = "$lang dilinde ürün adı metin olmalıdır";
            $messages["name:$lang.max"] = "$lang dilinde ürün adı en fazla 255 karakter olabilir";
        }

        return $messages;
    }
} 