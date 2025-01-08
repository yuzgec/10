<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = json_decode(file_get_contents(database_path('backups/sehir.json')), true)[0];
        
        foreach ($cities as $city) {
            City::create([
                'name' => $city['sehir_title'],
                'plate_no' => $city['id']  // Plaka numarası
            ]);
        }
    }
} 