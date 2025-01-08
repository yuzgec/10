<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;

class VariationService
{
    public function createVariations(Product $product, array $variations): void
    {
        try {
            DB::beginTransaction();

            foreach ($variations as $data) {
                $variation = $product->variations()->create([
                    'name' => $data['name'],
                    'sku' => $data['sku'],
                    'price' => $data['price'],
                    'discount_price' => $data['discount_price'] ?? null,
                    'stock' => $data['stock'],
                    'weight' => $data['weight'] ?? null,
                    'length' => $data['length'] ?? null,
                    'width' => $data['width'] ?? null,
                    'height' => $data['height'] ?? null,
                    'sort_order' => $data['sort_order'] ?? 0,
                    'status' => $data['status'] ?? true,
                ]);

                // Varyasyon özelliklerini ekle
                if (!empty($data['attributes'])) {
                    foreach ($data['attributes'] as $attributeId => $valueId) {
                        $variation->attributes()->create([
                            'attribute_id' => $attributeId,
                            'value_id' => $valueId
                        ]);
                    }
                }

                // Variation key oluştur
                $this->generateVariationKey($variation);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function generateVariationKey(ProductVariation $variation): void
    {
        $attributes = $variation->attributes()
            ->orderBy('attribute_id')
            ->get()
            ->pluck('value_id')
            ->join('-');

        $variation->update(['variation_key' => $attributes]);
    }
} 