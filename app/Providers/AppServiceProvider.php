<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Service;
use App\Models\Category;
use App\Models\Language;
use App\Observers\BlogObserver;
use App\Observers\PageObserver;
use App\Observers\ServiceObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Carbon::setLocale(config('app.locale'));
        Page::observe(PageObserver::class);
        Service::observe(ServiceObserver::class);
        Blog::observe(BlogObserver::class);
        

        if(Schema::hasTable('languages')){
            $languages = Language::active()->get();

            foreach ($languages as $item) {
                $supportedLocales[$item->lang] = [
                    'name' => $item->name,
                    'script' => $item->script,
                    'native' => $item->native,
                    'regional' => $item->regional,
                ];
            }
        }else {
            $supportedLocales = [
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
        }
        

        // Config içinde dinamik olarak `supportedLocales` değerini güncelle
        Config::set('laravellocalization.supportedLocales', $supportedLocales);


    }
}
