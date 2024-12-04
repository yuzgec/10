<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranslationRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'group' => 'required|string|max:255',
            'key' => 'required|string|max:255|unique:language_lines,key' . $this->id,
            'translations' => 'required|array',
            'translations.*' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'group.required' => 'Grup adı zorunludur.',
            'group.string' => 'Grup adı geçerli bir metin olmalıdır.',
            'group.max' => 'Grup adı en fazla 255 karakter olabilir.',
            'key.required' => 'Anahtar adı zorunludur.',
            'key.string' => 'Anahtar adı geçerli bir metin olmalıdır.',
            'key.max' => 'Anahtar adı en fazla 255 karakter olabilir.',
            'key.unique' => 'Bu anahtar adı zaten mevcut. Lütfen farklı bir anahtar adı kullanın.',
            'translations.required' => 'Çeviriler zorunludur.',
            'translations.array' => 'Çeviriler geçerli bir dizi formatında olmalıdır.',
            'translations.*.required' => 'Her dil için çeviri zorunludur.',
            'translations.*.string' => 'Çeviri metni geçerli bir metin olmalıdır.',
            'translations.*.max' => 'Çeviri metni en fazla 255 karakter olabilir.',
        ];
    }
}
