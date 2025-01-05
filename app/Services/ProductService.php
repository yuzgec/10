<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Observers\ProductObserver;

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
        $productData = [
            'sku' => $data['sku'],
            'price' => $data['price'],
            'stock' => $data['stock'] ?? 0,
            'type' => $data['type'],
            'featured' => $data['featured'] ?? false,
            'status' => $data['status'] ?? true,
        ];

        // Çevirili alanları ekle
        foreach (['name', 'description', 'seo_title', 'seo_description', 'seo_keywords'] as $field) {
            if (isset($data[$field])) {
                $productData[$field] = is_array($data[$field]) 
                    ? $data[$field] 
                    : [$this->languages[0] => $data[$field]];
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