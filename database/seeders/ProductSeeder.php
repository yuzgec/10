<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Enums\ProductTypeEnum;
use App\Models\AttributeValue;
use App\Models\VariationValue;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Örnek özellikler
        $colorAttr = ProductAttribute::create([
            'type' => 'color',
            'status' => 'published',
            'rank' => 1
        ]);

        $colorAttr->translations()->create([
            'locale' => 'tr',
            'name' => 'Renk',
            'slug' => Str::slug('Renk')
        ]);

        $sizeAttr = ProductAttribute::create([
            'type' => 'size',
            'status' => 'published',
            'rank' => 2
        ]);

        $sizeAttr->translations()->create([
            'locale' => 'tr',
            'name' => 'Beden',
            'slug' => Str::slug('Beden')
        ]);

        // Özellik değerleri
        $red = AttributeValue::create([
            'attribute_id' => $colorAttr->id,
            'color_code' => '#ff0000',
            'status' => 'published',
            'rank' => 1
        ]);

        $red->translations()->create([
            'locale' => 'tr',
            'name' => 'Kırmızı',
            'slug' => Str::slug('Kırmızı')
        ]);

        $blue = AttributeValue::create(['attribute_id' => $colorAttr->id, 'name' => 'Mavi', 'slug' => 'mavi', 'color_code' => '#0000ff']);
        
        $small = AttributeValue::create(['attribute_id' => $sizeAttr->id, 'name' => 'S', 'slug' => 's']);
        $medium = AttributeValue::create(['attribute_id' => $sizeAttr->id, 'name' => 'M', 'slug' => 'm']);

        // Basit Ürün
        $simpleProduct = Product::create([
            'name' => 'Basic T-Shirt',
            'slug' => 'basic-tshirt',
            'type' => ProductTypeEnum::SIMPLE->value
        ]);

        // Varyantlı Ürün
        $variableProduct = Product::create([
            'name' => 'Premium T-Shirt',
            'slug' => 'premium-tshirt',
            'type' => ProductTypeEnum::VARIABLE->value
        ]);

        // Varyasyonlar
        $variation1 = ProductVariation::create([
            'product_id' => $variableProduct->id,
            'name' => 'Kırmızı / S',
            'sku' => 'PTS-RS-001',
            'price' => 199.90,
            'stock' => 10,
            'is_default' => true
        ]);

        // Varyasyon değerleri
        VariationValue::create([
            'variation_id' => $variation1->id,
            'attribute_id' => $colorAttr->id,
            'value_id' => $red->id
        ]);

        VariationValue::create([
            'variation_id' => $variation1->id,
            'attribute_id' => $sizeAttr->id,
            'value_id' => $small->id
        ]);

        // İkinci varyasyon
        $variation2 = ProductVariation::create([
            'product_id' => $variableProduct->id,
            'name' => 'Mavi / M',
            'sku' => 'PTS-BM-002',
            'price' => 199.90,
            'stock' => 15
        ]);

        VariationValue::create([
            'variation_id' => $variation2->id,
            'attribute_id' => $colorAttr->id,
            'value_id' => $blue->id
        ]);

        VariationValue::create([
            'variation_id' => $variation2->id,
            'attribute_id' => $sizeAttr->id,
            'value_id' => $medium->id
        ]);
    }
} 