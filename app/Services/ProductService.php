<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function create(array $data): Product
    {
        try {
            DB::beginTransaction();

            // Ana ürün oluşturma
            $product = Product::create([
                'type' => $data['type'],
                'sku' => $data['sku'] ?? null,
                'price' => $data['price'] ?? null,
                'discount_price' => $data['discount_price'] ?? null,
                'stock' => $data['stock'] ?? null,
                'featured' => $data['featured'] ?? false,
                'tax_status' => $data['tax_status'] ?? 'taxable',
                'tax_class' => $data['tax_class'] ?? null,
                'manage_stock' => $data['manage_stock'] ?? true,
                'weight' => $data['weight'] ?? null,
                'dimension_unit' => $data['dimension_unit'] ?? null,
                'length' => $data['length'] ?? null,
                'width' => $data['width'] ?? null,
                'height' => $data['height'] ?? null,
                'status' => $data['status'] ?? true,
            ]);

            // Çeviriler
            foreach (config('app.locales') as $locale) {
                $product->translations()->create([
                    'locale' => $locale,
                    'name' => $data["name:$locale"],
                    'slug' => Str::slug($data["name:$locale"]) . '-' . Str::random(5),
                    'short' => $data["short:$locale"] ?? null,
                    'desc' => $data["desc:$locale"] ?? null,
                    'purchase_note' => $data["purchase_note:$locale"] ?? null,
                ]);
            }

            // Kategoriler
            if (!empty($data['categories'])) {
                $product->categories()->sync($data['categories']);
            }

            // Etiketler
            if (!empty($data['tags'])) {
                $product->syncTags($data['tags']);
            }

            // Medya
            if (!empty($data['image'])) {
                $product->addMedia($data['image'])
                    ->toMediaCollection('image');
            }

            if (!empty($data['gallery'])) {
                foreach ($data['gallery'] as $image) {
                    $product->addMedia($image)
                        ->toMediaCollection('gallery');
                }
            }

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

            // Ana ürün güncelleme
            $product->update([
                'sku' => $data['sku'] ?? null,
                'price' => $data['price'] ?? null,
                'discount_price' => $data['discount_price'] ?? null,
                'stock' => $data['stock'] ?? null,
                'featured' => $data['featured'] ?? false,
                'tax_status' => $data['tax_status'] ?? 'taxable',
                'tax_class' => $data['tax_class'] ?? null,
                'manage_stock' => $data['manage_stock'] ?? true,
                'weight' => $data['weight'] ?? null,
                'dimension_unit' => $data['dimension_unit'] ?? null,
                'length' => $data['length'] ?? null,
                'width' => $data['width'] ?? null,
                'height' => $data['height'] ?? null,
                'status' => $data['status'] ?? true,
            ]);

            // Çeviriler güncelleme
            foreach (config('app.locales') as $locale) {
                $product->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'name' => $data["name:$locale"],
                        'slug' => Str::slug($data["name:$locale"]) . '-' . Str::random(5),
                        'short' => $data["short:$locale"] ?? null,
                        'desc' => $data["desc:$locale"] ?? null,
                        'purchase_note' => $data["purchase_note:$locale"] ?? null,
                    ]
                );
            }

            // Kategoriler güncelleme
            if (isset($data['categories'])) {
                $product->categories()->sync($data['categories']);
            }

            // Etiketler güncelleme
            if (isset($data['tags'])) {
                $product->syncTags($data['tags']);
            }

            // Medya güncelleme
            if (!empty($data['image'])) {
                $product->clearMediaCollection('image');
                $product->addMedia($data['image'])
                    ->toMediaCollection('image');
            }

            if (!empty($data['gallery'])) {
                if (!empty($data['gallery_clear'])) {
                    $product->clearMediaCollection('gallery');
                }
                foreach ($data['gallery'] as $image) {
                    $product->addMedia($image)
                        ->toMediaCollection('gallery');
                }
            }

            DB::commit();
            return $product;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Product $product): bool
    {
        try {
            DB::beginTransaction();
            
            // İlişkili medyaları temizle
            $product->clearMediaCollection('image');
            $product->clearMediaCollection('gallery');
            
            $product->delete();
            
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
} 