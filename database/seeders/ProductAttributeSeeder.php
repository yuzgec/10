<?php

namespace Database\Seeders;

use App\Models\ProductAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductAttributeSeeder extends Seeder
{
    public function run()
    {
        // Renk özelliği
        $color = ProductAttribute::create([
            'type' => 'color',
            'status' => true,
            'rank' => 1
        ]);

        // Renk çevirileri
        $color->translations()->createMany([
            ['locale' => 'tr', 'name' => 'Renk', 'slug' => 'renk'],
            ['locale' => 'en', 'name' => 'Color', 'slug' => 'color']
        ]);

        $colors = [
            ['value' => 'Siyah', 'color_code' => '#000000'],
            ['value' => 'Beyaz', 'color_code' => '#FFFFFF'],
            ['value' => 'Kırmızı', 'color_code' => '#FF0000'],
            ['value' => 'Mavi', 'color_code' => '#0000FF'],
            ['value' => 'Yeşil', 'color_code' => '#00FF00']
        ];

        foreach ($colors as $index => $c) {
            $value = $color->values()->create([
                'color_code' => $c['color_code'],
                'sort_order' => $index
            ]);

            // Değer çevirileri
            $value->translations()->createMany([
                [
                    'locale' => 'tr',
                    'value' => $c['value'],
                    'slug' => Str::slug($c['value'])
                ],
                [
                    'locale' => 'en',
                    'value' => $this->getColorNameInEnglish($c['value']),
                    'slug' => Str::slug($this->getColorNameInEnglish($c['value']))
                ]
            ]);
        }

        // Beden özelliği
        $size = ProductAttribute::create([
            'type' => 'select',
            'status' => true,
            'rank' => 2
        ]);

        // Beden çevirileri
        $size->translations()->createMany([
            ['locale' => 'tr', 'name' => 'Beden', 'slug' => 'beden'],
            ['locale' => 'en', 'name' => 'Size', 'slug' => 'size']
        ]);

        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

        foreach ($sizes as $index => $s) {
            $value = $size->values()->create([
                'sort_order' => $index
            ]);

            // Değer çevirileri - beden için TR ve EN aynı
            $value->translations()->createMany([
                [
                    'locale' => 'tr',
                    'value' => $s,
                    'slug' => Str::slug($s)
                ],
                [
                    'locale' => 'en',
                    'value' => $s,
                    'slug' => Str::slug($s)
                ]
            ]);
        }
    }

    private function getColorNameInEnglish($turkishName)
    {
        return [
            'Siyah' => 'Black',
            'Beyaz' => 'White',
            'Kırmızı' => 'Red',
            'Mavi' => 'Blue',
            'Yeşil' => 'Green'
        ][$turkishName] ?? $turkishName;
    }
} 