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
use App\Observers\CategoryObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{

    public function register(){}

    public function boot(): void
    {

        Paginator::useBootstrap();
        Carbon::setLocale(config('app.locale'));
        Page::observe(PageObserver::class);
        Service::observe(ServiceObserver::class);
        Blog::observe(BlogObserver::class);
        Category::observe(CategoryObserver::class);

        //$lang = $languages->pluck('lang')->toArray(); // Sadece `lang` değerleri bir array olarak
        //dd($lang);

        //Config::set('translatable.locales', $lang);        
        //Config::set('laravellocalization.supportedLocales', $supportedLocales);


    }
}
