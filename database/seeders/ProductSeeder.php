<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Basit Ürünler
        $this->createSimpleProducts();
        
        // Varyantlı Ürünler
        $this->createVariableProducts();
    }

    private function createSimpleProducts()
    {
        $products = [
            [
                'name' => [
                    'tr' => 'iPhone 14 Pro',
                    'en' => 'iPhone 14 Pro'
                ],
                'price' => 54999,
                'brand_id' => Brand::where('name', 'Apple')->first()->id
            ],
            [
                'name' => [
                    'tr' => 'Samsung Galaxy S23',
                    'en' => 'Samsung Galaxy S23'
                ],
                'price' => 44999,
                'brand_id' => Brand::where('name', 'Samsung')->first()->id
            ]
        ];

        foreach ($products as $item) {
            $product = Product::create([
                'type' => 'simple',
                'price' => $item['price'],
                'stock' => rand(10, 100),
                'sku' => Str::random(8),
                'brand_id' => $item['brand_id'],
                'featured' => rand(0, 1),
                'status' => true
            ]);

            // Çeviriler
            foreach ($item['name'] as $locale => $name) {
                $product->translations()->create([
                    'locale' => $locale,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'short' => "Bu bir örnek {$name} açıklamasıdır.",
                    'desc' => "Bu bir örnek {$name} detaylı açıklamasıdır."
                ]);
            }
        }
    }

    private function createVariableProducts()
    {
        $products = [
            [
                'name' => [
                    'tr' => 'Nike Spor Ayakkabı',
                    'en' => 'Nike Sports Shoe'
                ],
                'brand_id' => Brand::where('name', 'Nike')->first()->id
            ],
            [
                'name' => [
                    'tr' => 'Adidas Tişört',
                    'en' => 'Adidas T-Shirt'
                ],
                'brand_id' => Brand::where('name', 'Adidas')->first()->id
            ]
        ];

        $colorAttribute = ProductAttribute::where('slug', 'renk')->first();
        $sizeAttribute = ProductAttribute::where('slug', 'beden')->first();

        foreach ($products as $item) {
            $product = Product::create([
                'type' => 'variable',
                'brand_id' => $item['brand_id'],
                'featured' => rand(0, 1),
                'status' => true
            ]);

            // Çeviriler
            foreach ($item['name'] as $locale => $name) {
                $product->translations()->create([
                    'locale' => $locale,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'short' => "Bu bir örnek {$name} açıklamasıdır.",
                    'desc' => "Bu bir örnek {$name} detaylı açıklamasıdır."
                ]);
            }

            // Varyantlar
            foreach ($colorAttribute->values as $color) {
                foreach ($sizeAttribute->values as $size) {
                    $variant = $product->variations()->create([
                        'name' => "{$item['name']['tr']} - {$color->value} / {$size->value}",
                        'sku' => Str::random(8),
                        'price' => rand(300, 1000),
                        'stock' => rand(5, 50),
                        'status' => true
                    ]);

                    // Varyant özellikleri
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
                }
            }
        }
    }
} 