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
            ProductSystemSeeder::class,
            TagSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
            BrandSeeder::class,
        ]);
    }
}
