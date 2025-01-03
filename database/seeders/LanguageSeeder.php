<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $locales = [
            'tr'=> ['name' => 'Turkish', 'active' => true, 'script' => 'Latn', 'native' => 'Türkçe', 'regional' => 'tr_TR'],
            'en'=> ['name' => 'English', 'active' => false, 'script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
            'es'=> ['name' => 'Spanish', 'active' => false, 'script' => 'Latn', 'native' => 'español', 'regional' => 'es_ES'],
            'de'=> ['name' => 'German', 'active' => false, 'script' => 'Latn', 'native' => 'Deutsch', 'regional' => 'de_DE'],
            'nl'=> ['name' => 'Dutch', 'active' => false, 'script' => 'Latn', 'native' => 'Nederlands', 'regional' => 'nl_NL'],
            'it'=> ['name' => 'Italian', 'active' => false, 'script' => 'Latn', 'native' => 'italiano', 'regional' => 'it_IT'],
            'ru'=> ['name' => 'Russian', 'active' => false, 'script' => 'Cyrl', 'native' => 'русский', 'regional' => 'ru_RU'],
            'fr'=> ['name' => 'French', 'active' => false, 'script' => 'Latn', 'native' => 'français', 'regional' => 'fr_FR'],
            'sa'=> ['name' => 'Arabic', 'active' => false, 'script' => 'Arab', 'native' => 'العربية', 'regional' => 'ar_AE'],
            'pt'=> ['name' => 'Portuguese', 'active' => false, 'script' => 'Latn', 'native' => 'português', 'regional' => 'pt_PT'],
            'ro'=> ['name' => 'Romanian', 'active' => false, 'script' => 'Latn', 'native' => 'română', 'regional' => 'ro_RO'],
        ];

        foreach ($locales as $lang => $details) {
            Language::create(array_merge(
                ['lang' => $lang],
                $details
            ));
        }

        // Temel çeviriler
        LanguageLine::create(['group' => 'site', 'key' => 'hakkimizda', 'text' => ['en' => 'About Us', 'tr' => 'Hakkımızda']]); 
        LanguageLine::create(['group' => 'site', 'key' => 'anasayfa', 'text' => ['en' => 'Home', 'tr' => 'Anasayfa']]);
    }
}
