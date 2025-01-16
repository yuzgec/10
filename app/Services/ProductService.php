<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Observers\ProductObserver;
use App\Models\TaxClass;

class ProductService
{
    private array $languages;

    public function __construct()
    {
        $this->languages = config('app.languages', ['tr']); // Varsayılan olarak tr
    }

    public function create(array $data): Product
    {
        try {
            DB::beginTransaction();

            // Ana ürün verilerini oluştur
            $product = Product::create($this->prepareProductData($data));

            // İlişkili verileri ekle
            $this->syncRelations($product, $data);
            
            // Medya dosyalarını ekle
            $this->handleMedia($product, $data);

            DB::commit();
            return $product;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(Product $product, array $data): Product
    {
        try {
            DB::beginTransaction();

            $product->update($this->prepareProductData($data));
            
            $this->syncRelations($product, $data);
            $this->handleMedia($product, $data, true);

            DB::commit();
            return $product;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function prepareProductData(array $data): array
    {
        // Non-translatable alanlar
        $productData = [
            'sku' => $data['sku'] ?? null,
            'price' => $data['price'] ?? 0,
            'discount_price' => $data['discount_price'] ?? 0,
            'stock' => $data['stock'] ?? 0,
            'type' => $data['type'] ?? 'simple',
            'featured' => $data['featured'] ?? false,
            'status' => $data['status'] ?? true,
            'brand_id' => $data['brand_id'] ?? null,
            'tax_status' => $data['tax_status'] ?? 'none',
            'tax_class_id' => $data['tax_class_id'] ?? null,
            
            // Dimension verileri
            'weight' => $data['weight'] ?? null,
            'dimension_unit' => $data['dimension_unit'] ?? 'cm',
            'length' => $data['length'] ?? null,
            'width' => $data['width'] ?? null,
            'height' => $data['height'] ?? null,

            // Stok Yönetimi
            'manage_stock' => $data['manage_stock'] ?? true,
            'min_stock_level' => $data['min_stock_level'] ?? null,
            'max_stock_level' => $data['max_stock_level'] ?? null,
            'stock_status' => $data['stock_status'] ?? 'in_stock',
            'allow_backorders' => $data['allow_backorders'] ?? false,
            'notify_low_stock' => $data['notify_low_stock'] ?? true,
            'low_stock_threshold' => $data['low_stock_threshold'] ?? null,
            'show_stock_quantity' => $data['show_stock_quantity'] ?? true,

            // Kargo & Teslimat
            'requires_shipping' => $data['requires_shipping'] ?? true,
            'delivery_time' => $data['delivery_time'] ?? null,

            // Özel Alanlar
            'warranty_period' => $data['warranty_period'] ?? null,
            'manufacturing_place' => $data['manufacturing_place'] ?? null,
            'barcode' => $data['barcode'] ?? null,
        ];

        // Vergi hesaplama
        if ($data['tax_status'] === 'taxable' && isset($data['tax_class_id'])) {
            $taxClass = TaxClass::find($data['tax_class_id']);
            if ($taxClass) {
                // Fiyat vergili olarak girilmiştir, vergi hariç fiyatı hesaplayalım
                $price = $data['price'];
                $taxRate = $taxClass->rate / 100;
                
                // Vergi hariç fiyat = Vergili fiyat / (1 + vergi oranı)
                $productData['price'] = round($price / (1 + $taxRate), 2);
                
                // İndirimli fiyat varsa onu da hesaplayalım
                if (!empty($data['discount_price'])) {
                    $discountPrice = $data['discount_price'];
                    $productData['discount_price'] = round($discountPrice / (1 + $taxRate), 2);
                }
            }
        }

        // Translatable alanları direkt aktar
        foreach ($data as $key => $value) {
            if (str_contains($key, ':')) {
                $productData[$key] = $value;
            }
        }

        return $productData;
    }

    private function syncRelations(Product $product, array $data): void
    {
        // Kategoriler
        if (isset($data['categories'])) {
            $product->categories()->sync($data['categories']);
        }

        // Etiketler
        if (isset($data['tags'])) {
            $product->tags()->sync($data['tags']);
        }

        // İlişkili Ürünler
        if (isset($data['related_products'])) {
            $product->relatedProducts()->sync($data['related_products']);
        }
    }

    private function handleMedia(Product $product, array $data, bool $isUpdate = false): void
    {
        if (!empty($data['image'])) {
            if ($isUpdate) {
                $product->clearMediaCollection('image');
            }
            $product->addMedia($data['image'])->toMediaCollection('image');
        }

        if (!empty($data['gallery'])) {
            if ($isUpdate) {
                $product->clearMediaCollection('gallery');
            }
            foreach ($data['gallery'] as $image) {
                $product->addMedia($image)->toMediaCollection('gallery');
            }
        }
    }

    public function delete(Product $product): void
    {
        try {
            DB::beginTransaction();
            
            $product->clearMediaCollection('image');
            $product->clearMediaCollection('gallery');
            $product->categories()->detach();
            $product->tags()->detach();
            $product->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
} 