<?php

namespace Database\Seeders;

use App\Models\Shop\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
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
            ],
            // Diğer markalar...
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
} 