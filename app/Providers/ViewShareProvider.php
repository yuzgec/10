<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Language;
use App\Enums\StatusEnum;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewShareProvider extends ServiceProvider
{
 
    public function boot(): void
    {
     
        $settings = Cache::remember('settings',now()->addYear(5), function () {
            return config()->set('settings', Setting::pluck('value','item')->all());
        });

        $status = Cache::remember('status',now()->addYear(5), function () {
            return collect(StatusEnum::cases());
        });

        $categories = Cache::remember('categories',now()->addYear(5), function () {
            return Category::withCount(['pages', 'services', 'blogs', 'faqs','media','teams'])->lang()->get()->toFlatTree();
        });

        $p_categories = Cache::remember('p_categories',now()->addYear(5), function () {
            return ProductCategory::withCount(['products','media'])->lang()->get()->toFlatTree();
        });


        $services = Cache::remember('services',now()->addYear(5), function () {
            return Service::with(['getCategory','media'])->active()->lang()->rank()->get();
        });

        $pages = Cache::remember('pages',now()->addYear(5), function () {
            return Page::with(['getCategory','media'])->active()->lang()->rank()->get();
        });

        $blog = Cache::remember('blogs',now()->addYear(5), function () {
            return Blog::with(['getCategory','media'])->active()->lang()->rank()->get();
        });

        $language = Cache::remember('language',now()->addYear(5), function () {
            return Language::active()->get();
        });

        $teams = Cache::remember('teams',now()->addYear(5), function () {
            return Page::with(['getCategory','media'])->active()->lang()->rank()->get();
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
            'p_categories' => $p_categories,
        ]);
    }
}