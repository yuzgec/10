<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Team;
use Livewire\Livewire;
use App\Models\Service;
use App\Models\Category;
use App\Models\Language;
use App\Observers\BlogObserver;
use App\Observers\PageObserver;
use App\Observers\TeamObserver;
use App\Observers\ProductObserver;



use App\Observers\ServiceObserver;
use App\Observers\CategoryObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\Livewire\ProductAttributeManager;



class AppServiceProvider extends ServiceProvider
{

    public function register(){}

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \App\Console\Commands\ImportCitiesAndDistricts::class,
            ]);
        }

        Paginator::useBootstrap();
        Carbon::setLocale(config('app.locale'));

        Page::observe(PageObserver::class);
        Service::observe(ServiceObserver::class);
        Blog::observe(BlogObserver::class);
        Category::observe(CategoryObserver::class);
        Team::observe(TeamObserver::class);
        Product::observe(ProductObserver::class);

        Livewire::component('product-attribute-manager', ProductAttributeManager::class);

        //$lang = $languages->pluck('lang')->toArray(); // Sadece `lang` değerleri bir array olarak
        //Config::set('translatable.locales', $lang);        
        //Config::set('laravellocalization.supportedLocales', $supportedLocales);
    }
}
