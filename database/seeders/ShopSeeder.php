<?php

namespace Database\Seeders;

use App\Enums\ProductTypeEnum;
use App\Enums\ProductAttributeType;
use App\Models\Shop\Product;
use App\Models\Shop\Brand;
use App\Models\Shop\Attribute;
use App\Models\Shop\AttributeValue;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        // Önce markaları oluştur
        $brands = [
            [
                'tr' => [
                    'name' => 'Nike',
                    'desc' => 'Nike markası açıklaması',
                    'seoTitle' => 'Nike Spor Ürünleri',
                    'seoDesc' => 'Nike spor ürünleri açıklaması',
                    'seoKey' => 'nike, spor, ayakkabı'
                ],
                'en' => [
                    'name' => 'Nike',
                    'desc' => 'Nike brand description',
                    'seoTitle' => 'Nike Sports Products',
                    'seoDesc' => 'Nike sports products description',
                    'seoKey' => 'nike, sports, shoes'
                ],
                'status' => true,
                'featured' => true
            ]
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        // Sonra özellikleri oluştur
        $attributes = [
            [
                'type' => ProductAttributeType::SELECT->value,
                'is_searchable' => true,
                'is_filterable' => true,
                'tr' => ['name' => 'Renk'],
                'en' => ['name' => 'Color'],
                'values' => [
                    [
                        'value' => '#ff0000',
                        'tr' => ['name' => 'Kırmızı'],
                        'en' => ['name' => 'Red']
                    ],
                    [
                        'value' => '#0000ff',
                        'tr' => ['name' => 'Mavi'],
                        'en' => ['name' => 'Blue']
                    ],
                    [
                        'value' => '#000000',
                        'tr' => ['name' => 'Siyah'],
                        'en' => ['name' => 'Black']
                    ]
                ]
            ],
            [
                'type' => ProductAttributeType::SELECT->value,
                'is_searchable' => true,
                'is_filterable' => true,
                'tr' => ['name' => 'Beden'],
                'en' => ['name' => 'Size'],
                'values' => [
                    [
                        'value' => 'S',
                        'tr' => ['name' => 'S'],
                        'en' => ['name' => 'S']
                    ],
                    [
                        'value' => 'M',
                        'tr' => ['name' => 'M'],
                        'en' => ['name' => 'M']
                    ],
                    [
                        'value' => 'L',
                        'tr' => ['name' => 'L'],
                        'en' => ['name' => 'L']
                    ],
                    [
                        'value' => 'XL',
                        'tr' => ['name' => 'XL'],
                        'en' => ['name' => 'XL']
                    ]
                ]
            ]
        ];

        foreach ($attributes as $attributeData) {
            $values = $attributeData['values'];
            unset($attributeData['values']);
            
            $attribute = Attribute::create($attributeData);

            foreach ($values as $valueData) {
                $attribute->values()->create($valueData);
            }
        }

        // Son olarak ürünleri oluştur
        // Basit Ürün Örneği
        $simpleProduct = Product::create([
            'type' => ProductTypeEnum::SIMPLE,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'price' => 199.90,
            'stock' => 100,
            'manage_stock' => true,
            'sku' => 'SIMPLE-001',
            'status' => true,
            'tr' => [
                'name' => 'Basit Ürün',
                'slug' => 'basit-urun',
                'short' => 'Kısa açıklama',
                'desc' => 'Detaylı açıklama',
                'seoTitle' => 'Basit Ürün SEO Başlığı',
                'seoDesc' => 'Basit Ürün SEO Açıklaması',
                'seoKey' => 'basit,urun,anahtar'
            ],
            'en' => [
                'name' => 'Simple Product',
                'slug' => 'simple-product',
                'short' => 'Short description',
                'desc' => 'Detailed description',
                'seoTitle' => 'Simple Product SEO Title',
                'seoDesc' => 'Simple Product SEO Description',
                'seoKey' => 'simple,product,keywords'
            ]
        ]);

        // Varyasyonlu Ürün Örneği
        $variableProduct = Product::create([
            'type' => ProductTypeEnum::VARIABLE,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'manage_stock' => true,
            'status' => true,
            'tr' => [
                'name' => 'Varyasyonlu T-Shirt',
                'slug' => 'varyasyonlu-tshirt',
                'short' => 'Farklı renk ve bedenlerde T-Shirt',
                'desc' => 'Detaylı ürün açıklaması',
                'seoTitle' => 'T-Shirt SEO Başlığı',
                'seoDesc' => 'T-Shirt SEO Açıklaması',
                'seoKey' => 'tshirt,giyim,renk,beden'
            ],
            'en' => [
                'name' => 'Variable T-Shirt',
                'slug' => 'variable-tshirt',
                'short' => 'T-Shirt in different colors and sizes',
                'desc' => 'Detailed product description',
                'seoTitle' => 'T-Shirt SEO Title',
                'seoDesc' => 'T-Shirt SEO Description',
                'seoKey' => 'tshirt,clothing,color,size'
            ]
        ]);

        // Varyasyonları Oluştur
        $colors = AttributeValue::whereHas('attribute', function($q) {
            $q->whereTranslation('name', 'Renk');
        })->get();

        $sizes = AttributeValue::whereHas('attribute', function($q) {
            $q->whereTranslation('name', 'Beden');
        })->get();

        foreach ($colors as $color) {
            foreach ($sizes as $size) {
                $variation = $variableProduct->variations()->create([
                    'sku' => "TSH-{$color->id}-{$size->id}",
                    'price' => rand(199, 299),
                    'stock' => rand(5, 20),
                    'status' => true
                ]);

                $variation->attributes()->attach([
                    $color->attr_id => ['attr_value_id' => $color->id],
                    $size->attr_id => ['attr_value_id' => $size->id]
                ]);
            }
        }
    }
} 