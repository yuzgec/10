<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name:tr' => 'required|max:255|min:3',
            'category_id' => 'required|exists:categories,id',
            'image' => 'file|image',
            'cover' => 'file|image',
        ];
    }

    public function messages(): array
    {
        return[
            'name:tr.required' => 'Zorunlu Alan',
            'name:tr.max' => 'En fazla 45 karakter olmalıdır',
            'name:tr.min' => 'En az 3 karakter olmalıdır',
            'category_id.required' => 'Zorunlu Alan',
            'category_id.exists' => 'Geçersiz kategori',
            'image.image' => 'Resim formatında olmalıdır.',
            'cover.image' => 'Resim formatında olmalıdır.',
            
        ];
    }
}
