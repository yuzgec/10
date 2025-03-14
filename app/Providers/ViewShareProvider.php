<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Brand;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Language;
use App\Enums\StatusEnum;
use App\Models\ExchangeRate;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewShareProvider extends ServiceProvider
{
 
    public function boot(): void
    {
     
        $settings = Cache::remember('settings',now()->addDay(1), function () {
            return config()->set('settings', Setting::pluck('value','item')->all());
        });

        $status = Cache::remember('status',now()->addDay(1), function () {
            return collect(StatusEnum::cases());
        });

        $services = Cache::remember('services',now()->addDay(1), function () {
            return Service::with(['getCategory','media'])->active()->lang()->rank()->get();
        });

        $pages = Cache::remember('pages',now()->addDay(1), function () {
            return Page::with(['getCategory','media'])->active()->lang()->rank()->get();
        });

        $blog = Cache::remember('blogs',now()->addDay(1), function () {
            return Blog::with(['getCategory','media'])->active()->lang()->rank()->get();
        });

        $language = Cache::remember('language',now()->addDay(1), function () {
            return Language::active()
                ->select(['id', 'lang', 'native', 'rank'])
                ->orderBy('rank')
                ->get();
        });

        $teams = Cache::remember('teams',now()->addDay(1), function () {
            return Page::with(['getCategory','media'])->active()->lang()->rank()->get();
        });


        $categories = Cache::remember('categories',now()->addDay(1), function () {
            return Category::withCount(['pages', 'services', 'blogs', 'faqs','media','teams'])->lang()->get()->toFlatTree();
        });

        //dd($language);
        //dd($categories->where('slug','video'));
  
        View::share([
            'blog'=> $blog,
            'categories' => $categories,
            'status' => $status,
            'services' => $services,
            'pages' => $pages,
            'teams' => $teams,
            'language' => $language,
        ]);
    }
}