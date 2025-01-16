<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\TaxClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $this->createSimpleProducts();
        $this->createVariableProducts();
    }

    private function createSimpleProducts()
    {
        $brand = Brand::where('name', 'GO Dijital')->first();

        $products = [
            [
                'name' => 'iPhone 14 Pro',
                'price' => 54999,
                'stock' => rand(10, 100),
                'weight' => 0.174,
                'dimension_unit' => 'mm',
            ]
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'type' => 'simple',
                'price' => $item['price'],
                'stock' => $item['stock'],
                'sku' => Str::random(8),
                'brand_id' => $brand->id,
                'featured' => rand(0, 1),
                'status' => 'published',
                'manage_stock' => true,
                'weight' => $item['weight'],
                'dimension_unit' => $item['dimension_unit'],
                'addGoogle' => true,
                'addComment' => false,
                'deleteContent' => false,
            ]);

            $product->translations()->create([
                'locale' => 'tr',
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'short' => "Bu bir örnek {$item['name']} kısa açıklamasıdır.",
                'desc' => "Bu bir örnek {$item['name']} detaylı açıklamasıdır.",
                'seoTitle' => $item['name'],
                'seoDesc' => "En uygun fiyatlarla {$item['name']} satın alın",
                'seoKey' => strtolower($item['name'])
            ]);
        }
    }

    private function createVariableProducts()
    {
        $brand = Brand::where('name', 'GO Dijital')->first();
        $colorAttribute = ProductAttribute::where('type', 'color')->first();
        $sizeAttribute = ProductAttribute::where('type', 'select')->first();

        $products = [
            [
                'name' => 'Nike Spor Ayakkabı',
                'weight' => 0.3,
                'dimension_unit' => 'cm',
            ]
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'type' => 'variable',
                'brand_id' => $brand->id,
                'featured' => rand(0, 1),
                'status' => 'published',
                'weight' => $item['weight'],
                'dimension_unit' => $item['dimension_unit'],
                'manage_stock' => true,
                'addGoogle' => true,
                'addComment' => false,
                'deleteContent' => false,
                'sku' => rand(1, 999999),
            ]);

            $product->translations()->create([
                'locale' => 'tr',
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'short' => "Bu bir örnek {$item['name']} kısa açıklamasıdır.",
                'desc' => "Bu bir örnek {$item['name']} detaylı açıklamasıdır.",
                'seoTitle' => $item['name'],
                'seoDesc' => "En uygun fiyatlarla {$item['name']} satın alın",
                'seoKey' => strtolower($item['name'])
            ]);

            // Varyasyonları doğrudan oluştur
            foreach ($colorAttribute->values as $color) {
                foreach ($sizeAttribute->values as $size) {
                    $variant = $product->variations()->create([
                        'sku' => Str::random(8),
                        'price' => rand(300, 1000),
                        'stock' => rand(5, 50),
                        'status' => true,
                    ]);

                    // Varyasyon özelliklerini ekle
                    $variant->attributes()->createMany([
                        [
                            'attribute_id' => $colorAttribute->id,
                            'value_id' => $color->id
                        ],
                        [
                            'attribute_id' => $sizeAttribute->id,
                            'value_id' => $size->id
                        ]
                    ]);

                    // Variation key oluştur
                    $variant->update([
                        'variation_key' => "{$color->id}-{$size->id}"
                    ]);
                }
            }
        }
    }
} 