<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpleProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.*' => 'required',
            'slug.*' => 'required',
            'description.*' => 'nullable',
            'sku' => 'required|unique:products,sku,' . ($this->product ? $this->product->id : ''),
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'brand_id' => 'nullable|exists:brands,id',
            'tax_status' => 'required|in:taxable,none',
            'tax_class_id' => 'required_if:tax_status,taxable|nullable|exists:tax_classes,id',
            'featured' => 'boolean',
            'status' => 'boolean',
            
            // Kategoriler için kurallar
            'categories' => 'required|array|min:1',
            'categories.*' => 'required|integer|exists:product_categories,id',
            
            // Stok Yönetimi
            'manage_stock' => 'boolean',
            'min_stock_level' => 'nullable|required_if:manage_stock,1|numeric|min:0',
            'max_stock_level' => 'nullable|required_if:manage_stock,1|numeric|min:0',
            'stock_status' => 'required|in:in_stock,out_of_stock,on_backorder',
            'allow_backorders' => 'boolean',
            'notify_low_stock' => 'boolean',
            'low_stock_threshold' => 'required_if:notify_low_stock,1|nullable|numeric|min:0',
            'show_stock_quantity' => 'boolean',
            
            // Kargo & Teslimat
            'requires_shipping' => 'boolean',
            'delivery_time' => 'required_if:requires_shipping,1|nullable|numeric|min:0',
            
            // İlişkili Ürünler
            'related_products' => 'nullable|array',
            'related_products.*' => 'nullable|integer|exists:products,id'
        ];
    }

    protected function prepareForValidation()
    {
        // İlişkili ürünleri işle
        if ($this->has('related_products') && is_string($this->related_products)) {
            $relatedProducts = json_decode($this->related_products, true);
            $this->merge([
                'related_products' => array_filter($relatedProducts ?? [])
            ]);
        }

        // Kategorileri işle
        if ($this->has('categories')) {
            $categories = is_array($this->categories) ? $this->categories : [$this->categories];
            $this->merge([
                'categories' => array_filter(array_map('intval', $categories))
            ]);
        }

        // Boolean değerleri işle
        $this->merge([
            'manage_stock' => $this->boolean('manage_stock'),
            'requires_shipping' => $this->boolean('requires_shipping'),
            'notify_low_stock' => $this->boolean('notify_low_stock'),
            'allow_backorders' => $this->boolean('allow_backorders'),
            'show_stock_quantity' => $this->boolean('show_stock_quantity'),
            'featured' => $this->boolean('featured'),
            'status' => $this->boolean('status'),
        ]);
    }

    public function messages()
    {
        return [
            'categories.required' => 'En az bir kategori seçmelisiniz.',
            'categories.min' => 'En az bir kategori seçmelisiniz.',
            'categories.*.exists' => 'Seçilen kategori geçersiz.',
            'categories.*.integer' => 'Kategori değeri geçersiz.',
            'related_products.*.exists' => 'Seçilen ilişkili ürün geçersiz.',
            'low_stock_threshold.required_if' => 'Düşük stok bildirimi açıkken düşük stok eşiği zorunludur.',
            'delivery_time.required_if' => 'Kargo gerekli iken teslimat süresi zorunludur.',
            'min_stock_level.required_if' => 'Stok takibi açıkken minimum stok seviyesi zorunludur.',
            'max_stock_level.required_if' => 'Stok takibi açıkken maksimum stok seviyesi zorunludur.',
        ];
    }
}