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
            'sku' => 'required|string|max:255|unique:products,sku,' . ($this->product ? $this->product->id : ''),
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
            'selectedAttributes.*' => 'nullable|exists:product_attribute_values,id',
            
            // Stok Yönetimi - manage_stock true ise zorunlu
            'manage_stock' => 'boolean',
            'min_stock_level' => 'nullable|required_if:manage_stock,true|integer|min:0',
            'stock_status' => 'required_if:manage_stock,true|in:in_stock,out_of_stock,on_backorder',
            'allow_backorders' => 'boolean',
            'notify_low_stock' => 'boolean',
            'low_stock_threshold' => 'nullable|required_if:notify_low_stock,true|integer|min:0',
            'show_stock_quantity' => 'boolean',
            
            // Kargo & Teslimat - requires_shipping true ise zorunlu
            'requires_shipping' => 'boolean',
            'delivery_time' => 'nullable|required_if:requires_shipping,true|integer|min:0',
            
            // Özel Alanlar
            'warranty_period' => 'nullable|integer|min:0',
            'manufacturing_place' => 'nullable|string|max:255',
            'barcode' => 'nullable|string|max:255|unique:products,barcode,' . ($this->product ? $this->product->id : '')
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
            'selectedAttributes.*' => 'Özellik değeri',
            
            // Stok Yönetimi
            'manage_stock' => 'Stok Takibi',
            'min_stock_level' => 'Minimum Stok Seviyesi',
            'stock_status' => 'Stok Durumu',
            'allow_backorders' => 'Ön Siparişe İzin Ver',
            'notify_low_stock' => 'Düşük Stok Bildirimi',
            'low_stock_threshold' => 'Düşük Stok Eşiği',
            'show_stock_quantity' => 'Stok Miktarını Göster',
            
            // Kargo & Teslimat
            'requires_shipping' => 'Kargo Gerekli',
            'delivery_time' => 'Teslimat Süresi',
            
            // Özel Alanlar
            'warranty_period' => 'Garanti Süresi',
            'manufacturing_place' => 'Üretim Yeri',
            'barcode' => 'Barkod'
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
        return [
            'sku.required' => 'SKU alanı zorunludur',
            'sku.unique' => 'Bu SKU kodu zaten kullanılmış',
            'price.required' => 'Fiyat alanı zorunludur',
            'price.numeric' => 'Fiyat sayısal bir değer olmalıdır',
            'price.min' => 'Fiyat 0\'dan büyük olmalıdır',
            'stock.required' => 'Stok alanı zorunludur',
            'stock.integer' => 'Stok tam sayı olmalıdır',
            'stock.min' => 'Stok 0\'dan büyük olmalıdır',
            'categories.required' => 'En az bir kategori seçmelisiniz',
            
            // Stok Yönetimi
            'min_stock_level.required_if' => 'Stok takibi açıkken minimum stok seviyesi zorunludur',
            'min_stock_level.integer' => 'Minimum stok seviyesi tam sayı olmalıdır',
            'min_stock_level.min' => 'Minimum stok seviyesi 0\'dan büyük olmalıdır',
            'stock_status.required_if' => 'Stok takibi açıkken stok durumu seçmelisiniz',
            'stock_status.in' => 'Geçersiz stok durumu',
            'low_stock_threshold.required_if' => 'Düşük stok bildirimi açıkken düşük stok eşiği zorunludur',
            
            // Kargo & Teslimat
            'delivery_time.required_if' => 'Kargo gerekli iken teslimat süresi zorunludur',
            'delivery_time.integer' => 'Teslimat süresi tam sayı olmalıdır',
            'delivery_time.min' => 'Teslimat süresi 0\'dan büyük olmalıdır'
        ];
    }
} 