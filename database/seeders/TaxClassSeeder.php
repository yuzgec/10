<?php

namespace Database\Seeders;

use App\Models\TaxClass;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TaxClassSeeder extends Seeder
{
    public function run()
    {

        TaxClass::create([
            'name' => 'KDV %1',
            'rate' => 1.00,
            'is_default' => false
        ]);

        TaxClass::create([
            'name' => 'KDV %10',
            'rate' => 10.00,
            'is_default' => false
        ]);

        TaxClass::create([
            'name' => 'KDV %20',
            'rate' => 20.00,
            'is_default' => true
        ]);
    }
} 