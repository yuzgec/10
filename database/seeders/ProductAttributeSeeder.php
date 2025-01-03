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
            'name' => 'Renk',
            'slug' => 'renk',
            'type' => 'color'
        ]);

        $colors = [
            ['value' => 'Siyah', 'color_code' => '#000000'],
            ['value' => 'Beyaz', 'color_code' => '#FFFFFF'],
            ['value' => 'Kırmızı', 'color_code' => '#FF0000'],
            ['value' => 'Mavi', 'color_code' => '#0000FF'],
            ['value' => 'Yeşil', 'color_code' => '#00FF00']
        ];

        foreach ($colors as $index => $c) {
            $color->values()->create([
                'value' => $c['value'],
                'slug' => Str::slug($c['value']),
                'color_code' => $c['color_code'],
                'sort_order' => $index
            ]);
        }

        // Beden özelliği
        $size = ProductAttribute::create([
            'name' => 'Beden',
            'slug' => 'beden',
            'type' => 'select'
        ]);

        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

        foreach ($sizes as $index => $s) {
            $size->values()->create([
                'value' => $s,
                'slug' => Str::slug($s),
                'sort_order' => $index
            ]);
        }
    }
} 