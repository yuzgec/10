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
            'sku' => 'required|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:product_categories,id',
            'tags' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        // Aktif diller için validasyon
        foreach (config('app.languages', ['tr']) as $lang) {
            $rules["name:$lang"] = 'required|string|max:255';
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