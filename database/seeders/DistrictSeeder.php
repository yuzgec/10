<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run()
    {
        $districts = json_decode(file_get_contents(database_path('backups/ilce.json')), true)[0];
        
        foreach ($districts as $district) {
            District::create([
                'city_id' => (int)$district['ilce_sehirkey'],
                'name' => $district['ilce_title'],
                'district_id' => (int)$district['ilce_key']
            ]);
        }
    }
} 