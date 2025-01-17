<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            CustomerSeeder::class,
            BrandSeeder::class,
            ProductAttributeSeeder::class,
            TaxClassSeeder::class,
            ProductSeeder::class,
            ProductCategorySeeder::class,
            TagSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
        ]);
    }
}
