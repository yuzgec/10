<?php

namespace Database\Seeders;

use App\Models\Shop\Brand;
use App\Models\Shop\Product;

use Illuminate\Database\Seeder;
use Database\Seeders\ShopSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ShopSeeder::class,
            UserSeeder::class,
        ]);

        // Test verileri için factory kullanımı
        Brand::factory(5)->create();
        Product::factory(20)
            ->simple()
            ->create();
    }
}