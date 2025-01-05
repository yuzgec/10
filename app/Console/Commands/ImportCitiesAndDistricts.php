<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\District;
use Illuminate\Console\Command;

class ImportCitiesAndDistricts extends Command
{
    protected $signature = 'import:cities-districts';
    protected $description = 'Import cities and districts of Turkey';

    public function handle()
    {
        $this->info('Importing cities and districts...');

        // İlleri ve ilçeleri içeren JSON dosyasını okuyalım
        $data = json_decode(file_get_contents(database_path('data/cities.json')), true);

        foreach ($data as $cityData) {
            $city = City::create([
                'name' => $cityData['name'],
                'plate_no' => $cityData['plate_no']
            ]);

            foreach ($cityData['districts'] as $districtName) {
                District::create([
                    'city_id' => $city->id,
                    'name' => $districtName
                ]);
            }
        }

        $this->info('Import completed successfully!');
    }
} 