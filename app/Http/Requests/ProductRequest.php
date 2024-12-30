<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];
        $lang = Language::active()->get();
        // Her dil için kurallar
        foreach($lang as $locale) {
            $rules[$locale.'.name'] = 'required|string|max:255';
            $rules[$locale.'.slug'] = 'nullable|string|max:255';
            $rules[$locale.'.short'] = 'nullable|string';
            $rules[$locale.'.desc'] = 'nullable|string';
        }

        // Genel kurallar
        $rules += [
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:product_brands,id',
            'status' => 'required|boolean',
            'has_variants' => 'boolean',
            
            // Varyantsız ürün için
            'price' => 'required_if:has_variants,false|nullable|numeric|min:0',
            'stock' => 'required_if:has_variants,false|nullable|integer|min:0',
            'sku' => 'required_if:has_variants,false|nullable|string|max:50',

            // Varyantlar için
            'variants' => 'required_if:has_variants,true|array',
            'variants.*.name' => 'required_if:has_variants,true|string|max:255',
            'variants.*.price' => 'required_if:has_variants,true|numeric|min:0',
            'variants.*.stock' => 'required_if:has_variants,true|integer|min:0',
            'variants.*.sku' => 'required_if:has_variants,true|string|max:50',
            'variants.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Medya
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach(config('translatable.locales') as $locale) {
            $messages[$locale.'.name.required'] = $locale.' dilinde ürün adı gereklidir';
            // ... diğer mesajlar
        }

        return $messages;
    }
} 