<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Enums\ProductType;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Enums\ProductAttributeType;
use App\Models\ProductAttributeValue;

class ProductSystemSeeder extends Seeder
{
    public function run()
    {
        // 1. Özellikler
        $color = ProductAttribute::create([
            'type' => ProductAttributeType::COLOR->value,
            'status' => true,
            'rank' => 1
        ]);

        $color->translateOrNew('tr')->name = 'Renk';
        $color->translateOrNew('en')->name = 'Color';
        $color->save();

        $size = ProductAttribute::create([
            'type' => ProductAttributeType::SELECT->value,  
            'status' => true,
            'rank' => 2
        ]);

        $size->translateOrNew('tr')->name = 'Beden';
        $size->translateOrNew('en')->name = 'Size';
        $size->save();

        // 2. Özellik Değerleri
        // Renkler
        $colors = [
            ['name' => ['tr' => 'Siyah', 'en' => 'Black'], 'color_code' => '#000000'],
            ['name' => ['tr' => 'Beyaz', 'en' => 'White'], 'color_code' => '#FFFFFF'],
            ['name' => ['tr' => 'Kırmızı', 'en' => 'Red'], 'color_code' => '#FF0000'],
            ['name' => ['tr' => 'Mavi', 'en' => 'Blue'], 'color_code' => '#0000FF']
        ];

        foreach ($colors as $c) {
            $value = ProductAttributeValue::create([
                'attribute_id' => $color->id,
                'color_code' => $c['color_code'],
                'status' => true
            ]);

            $value->translateOrNew('tr')->name = $c['name']['tr'];
            $value->translateOrNew('en')->name = $c['name']['en'];
            $value->save();
        }

        // Bedenler
        $sizes = ['XS', 'S', 'M', 'L', 'XL'];

        foreach ($sizes as $index => $size_name) {
            $value = ProductAttributeValue::create([
                'attribute_id' => $size->id,
                'status' => true,
                'rank' => $index + 1
            ]);

            $value->translateOrNew('tr')->name = $size_name;
            $value->translateOrNew('en')->name = $size_name;
            $value->save();
        }

        // 3. Örnek Ürünler
        // Basit Ürün
        $simpleProduct = Product::create([
            'type' => 1,
            'sku' => 'GO-001',
            'price' => 199.90,
            'stock' => 100,
            'status' => true,
            'tr' => [
                'name' => 'Basic T-Shirt',
                'short' => 'Pamuklu basic t-shirt',
                'desc' => 'Yüksek kalite pamuklu kumaştan üretilmiş basic t-shirt'
            ],
            'en' => [
                'name' => 'Basic T-Shirt',
                'short' => 'Cotton basic t-shirt',
                'desc' => 'Basic t-shirt made from high quality cotton fabric'
            ]
        ]);

        // Varyasyonlu Ürün
        $variableProduct = Product::create([
            'type' => 2,
            'sku' => 'GO-TS-001',
            'status' => true,
            'tr' => [
                'name' => 'Renkli T-Shirt',
                'slug' => 'renkli-t-shirt',
                'short' => 'Farklı renk seçenekli t-shirt',
                'desc' => 'Pamuklu kumaştan üretilmiş, farklı renk ve beden seçenekli t-shirt'
            ],
            'en' => [
                'name' => 'Colored T-Shirt',
                'slug' => 'colored-t-shirt',
                'short' => 'T-shirt with different color options',
                'desc' => 'Cotton t-shirt with multiple color and size options'
            ]
        ]);

        // Örnek varyasyonlar ve değerleri
        $variations = [
            [
                'color' => 'siyah', 
                'size' => 'm', 
                'price' => 199.90, 
                'stock' => 50, 
                'is_default' => true
            ],
            [
                'color' => 'siyah', 
                'size' => 'l', 
                'price' => 199.90, 
                'stock' => 50
            ],
            [
                'color' => 'beyaz', 
                'size' => 'm', 
                'price' => 199.90, 
                'stock' => 50
            ],
            [
                'color' => 'beyaz', 
                'size' => 'l', 
                'price' => 199.90, 
                'stock' => 50
            ],
        ];

        foreach ($variations as $key => $var) {
            // Varyasyon oluştur
            $variation = $variableProduct->variations()->create([
                'sku' => 'GO-TS-' . strtoupper(substr($var['color'], 0, 1)) . substr($var['size'], 0, 1) . '-' . str_pad($key + 1, 3, '0', STR_PAD_LEFT),
                'price' => $var['price'],
                'stock' => $var['stock'],
                'status' => true,
                'is_default' => $var['is_default'] ?? false,
                'sort_order' => $key
            ]);

            // Renk değerini bul ve ekle
            $colorValue = ProductAttributeValue::whereHas('translations', function($q) use ($var) {
                $q->where('name', ucfirst($var['color']));
            })->first();

            if ($colorValue) {
                $variation->attributeValues()->attach($colorValue->id, ['attribute_id' => $color->id]);
            }

            // Beden değerini bul ve ekle
            $sizeValue = ProductAttributeValue::where('attribute_id', $size->id)
                ->whereHas('translations', function($q) use ($var) {
                    $q->where('name', strtoupper($var['size']));
                })->first();

            if ($sizeValue) {
                $variation->attributeValues()->attach($sizeValue->id, ['attribute_id' => $size->id]);
            }
        }
    }
} 