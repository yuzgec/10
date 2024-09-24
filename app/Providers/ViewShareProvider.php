<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Service;
use App\Models\Category;
use App\Models\Language;
use App\Enums\StatusEnum;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewShareProvider extends ServiceProvider
{
 
    public function boot(): void
    {
     

        $status = Cache::remember('status',now()->addYear(5), function () {
            return collect(StatusEnum::cases());
        });


        $categories = Category::withCount(['pages', 'services', 'blogs', 'faqs', 'products'])->lang()->get()->toFlatTree();
        $services = Service::with(['getCategory'])->active()->lang()->get();
        $pages = Page::with(['getCategory'])->active()->lang()->get();
        $blogs =Blog::with(['getCategory'])->active()->lang()->get();
        $language = Language::active()->get();
  
        View::share([
             'categories' => $categories,
            'status' => $status,
            'services' => $services,
            'pages' => $pages,
            'blogs', $blogs,
            'language' => $language,
        ]);
    }
}
