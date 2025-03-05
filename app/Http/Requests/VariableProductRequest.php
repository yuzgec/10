<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariableProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'sku' => 'nullable|unique:products,sku,' . ($this->product ? $this->product->id : ''),
            'status' => 'boolean',
            'featured' => 'boolean',
            'brand_id' => 'nullable|exists:brands,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];

        // Çoklu dil desteği için kurallar
        foreach (config('app.locales', ['tr']) as $locale) {
            $rules["$locale.name"] = 'required|string|max:255';
            $rules["$locale.slug"] = 'required|string|max:255|unique:product_translations,slug,' . 
                                     ($this->product ? ($this->product->translate($locale)->id ?? '') : '') . 
                                     ',id,locale,' . $locale;
            $rules["$locale.short"] = 'nullable|string';
            $rules["$locale.desc"] = 'nullable|string';
            $rules["$locale.technical_desc"] = 'nullable|string';
            $rules["$locale.cargo_desc"] = 'nullable|string';
            $rules["$locale.seoTitle"] = 'nullable|string|max:255';
            $rules["$locale.seoDesc"] = 'nullable|string|max:255';
            $rules["$locale.seoKey"] = 'nullable|string|max:255';
        }

        // Medya kuralları
        $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        $rules['gallery.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        $messages = [
            'categories.required' => 'En az bir kategori seçmelisiniz.',
            'categories.array' => 'Kategoriler bir dizi olarak gönderilmelidir.',
            'categories.*.exists' => 'Seçilen kategori geçersiz.',
        ];

        // Çoklu dil desteği için mesajlar
        foreach (config('app.locales', ['tr']) as $locale) {
            $messages["$locale.name.required"] = "$locale dilinde ürün adı gereklidir.";
            $messages["$locale.slug.required"] = "$locale dilinde ürün slug değeri gereklidir.";
            $messages["$locale.slug.unique"] = "$locale dilinde bu slug değeri zaten kullanılıyor.";
        }

        return $messages;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('categories')) {
            $categories = $this->categories;
            
            if (!is_array($categories)) {
                $categories = explode(',', $categories);
            }
            
            $categories = array_filter($categories, function($value) {
                return !empty($value) && is_numeric($value);
            });
            
            if (!empty($categories)) {
                $this->merge(['categories' => array_values($categories)]);
            }
        }
    }
} 