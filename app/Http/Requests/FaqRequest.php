<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name:tr'                  => 'required|max:255|min:6',
            'category_id'              => 'required|exists:categories,id',

        ];
    }

    public function messages():array
    {
      return[
        'name:tr.required'             => 'Zorunlu Alan',
        'name:tr.max'                  => 'En fazla 255 karakterden oluşmalıdır.',
        'name:tr.min'                  => 'En az 6 karakterden oluşmalıdır.',
        'category_id.required'        => 'Zorunlu Alan',
        'category_id.exists'          => 'Geçersiz kategori',
      ];
    }
}
