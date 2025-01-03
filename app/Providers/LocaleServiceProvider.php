<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use App\Models\Language;
use Illuminate\Support\Facades\Schema;

class LocaleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        try {
            if (Schema::hasTable('languages')) {
                $languages = Language::where('active', true)
                    ->get()
                    ->mapWithKeys(function ($language) {
                        return [$language->lang => [
                            'name' => $language->name,
                            'script' => $language->script,
                            'native' => $language->native,
                            'regional' => $language->regional,
                            'active' => $language->active
                        ]];
                    })
                    ->toArray();

                if (!empty($languages)) {
                    Config::set('laravellocalization.supportedLocales', $languages);
                    Config::set('app.locales', array_keys($languages));
                }
            }
        } catch (\Exception $e) {
            // Fallback to default configuration
            Config::set('laravellocalization.supportedLocales', ['tr' => [
                'name' => 'Turkish',
                'script' => 'Latn',
                'native' => 'Türkçe',
                'regional' => 'tr_TR',
                'active' => true
            ]]);
            Config::set('app.locales', ['tr']);
        }
    }
}
