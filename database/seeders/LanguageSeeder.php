<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguageSeeder extends Seeder
{
/**
 * Run the database seeds.
 */
public function run(): void
{



 $locales = [
    'tr'=> ['name' => 'Turkish','active' => true, 'script' => 'Latn', 'native' => 'Türkçe', 'regional' => 'tr_TR'],
    'en'=> ['name' => 'English','active' => true, 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
    'es'=> ['name' => 'Spanish','script' => 'Latn', 'native' => 'español', 'regional' => 'es_ES'],
    'de'=> ['name' => 'German', 'script' => 'Latn', 'native' => 'Deutsch', 'regional' => 'de_DE'],
    'nl'=> ['name' => 'Dutch','script' => 'Latn', 'native' => 'Nederlands', 'regional' => 'nl_NL'],
    'it'=> ['name' => 'Italian','script' => 'Latn', 'native' => 'italiano', 'regional' => 'it_IT'],
    'ru'=> ['name' => 'Russian','script' => 'Cyrl', 'native' => 'русский', 'regional' => 'ru_RU'],
    'fr'=> ['name' => 'French','script' => 'Latn', 'native' => 'français', 'regional' => 'fr_FR'],
    'sa'=> ['name' => 'Arabic', 'script' => 'Arab', 'native' => 'العربية', 'regional' => 'ar_AE'],
    'pt'=> ['name' => 'Portuguese','script' => 'Latn', 'native' => 'português', 'regional' => 'pt_PT'],
    'ro'=> ['name' => 'Romanian','script' => 'Latn', 'native' => 'română', 'regional' => 'ro_RO'],

        //'sv'          => ['name' => 'Swedish',                'script' => 'Latn', 'native' => 'svenska', 'regional' => 'sv_SE'],

];

foreach ($locales as $lang => $details) {
Language::create([
'lang' => $lang,
'name' => $details['name'],
'script' => $details['script'],
'native' => $details['native'],
'regional' => $details['regional'],
'active' => $details['active'] ?? false,
]);
}
}
}
