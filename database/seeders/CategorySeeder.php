<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Sayfa']);
        Category::create(['name' => 'Hizmet']);
        Category::create(['name' => 'Blog']);
        Category::create(['name' => 'Galeri']);
        Category::create(['name' => 'SSS']);
        Category::create(['name' => 'Proje']);
        Category::create(['name' => 'Ürünler']);
        Category::create(['name' => 'Ayarlar']);
    }
} 