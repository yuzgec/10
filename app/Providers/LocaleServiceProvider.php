<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use App\Models\Language;

class LocaleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {

        $supportedLocales = ['tr','en'];

        $languages = Language::active()->get();

        foreach ($languages as $item) {
            $supportedLocales[$item->lang] = [
                'name' => $item->name,
                'script' => $item->script,
                'native' => $item->native,
                'regional' => $item->regional,
            ];
        }

        // Config içinde dinamik olarak `supportedLocales` değerini güncelle
        Config::set('laravellocalization.supportedLocales', $supportedLocales);

        //dd($supportedLocales);

        //dd(config('laravellocalization.supportedLocales'));
    }
}
