<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $brands = [
            'Nike', 'Adidas', 'Puma', 'Reebok', 'Under Armour',
            'New Balance', 'Asics', 'Converse', 'Vans', 'Skechers'
        ];

        foreach ($brands as $index => $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'status' => true,
                'rank' => $index
            ]);
        }
    }
} 