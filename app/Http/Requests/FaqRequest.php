<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

      $languages = Language::active()->pluck('lang')->toArray();
      $rules = [];

      // Her dil için name validasyonu
      foreach ($languages as $lang) {
          $rules["name:{$lang}"] = 'required|max:255|min:3';
          
          // Güncelleme durumunda unique kontrolü
          if ($this->isMethod('put') || $this->isMethod('patch')) {
            $faqId = $this->segment(5); // URL'den blog ID'sini al
            $rules["name:{$lang}"] .= '|unique:faq_translations,name,' . $faqId . ',faq_id,locale,' . $lang;
          } else {
              $rules["name:{$lang}"] .= '|unique:faq_translations,name,NULL,faq_id,locale,' . $lang;
          }
      }

      // Diğer validasyon kuralları
      $rules += [
          'category_id' => 'required|exists:categories,id',
      ];

      return $rules;

    }

    public function messages():array
    {
      return[
        'name:*.required'              => 'Zorunlu Alan',
        'name:*.max'                   => 'En fazla 45 karakter olmalıdır',
        'name:*.min'                   => 'En az 3 karakter olmalıdır',
        'name:*.unique'                => 'Bu isim zaten kullanılıyor',
        'category_id.required'         => 'Zorunlu Alan',
        'category_id.exists'           => 'Geçersiz kategori',
      ];
    }
}
