<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
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
     
        config()->set('settings', Setting::pluck('value','item')->all());

        $status = Cache::remember('status',now()->addYear(5), function () {
            return collect(StatusEnum::cases());
        });

        $categories = Category::withCount(['pages', 'services', 'blogs', 'faqs', 'products','media'])->lang()->get()->toFlatTree();
        $services = Service::with(['getCategory','media'])->active()->lang()->rank()->get();
        $pages = Page::with(['getCategory','media'])->active()->lang()->get();
        $blog =Blog::with(['getCategory','media'])->active()->lang()->rank()->get();

        $language = Cache::remember('language',now()->addYear(5), function () {
            return Language::active()->get();
        });


        //dd($blogs);


        //dd($language);

  
        View::share([
            'blog'=> $blog,
            'categories' => $categories,
            'status' => $status,
            'services' => $services,
            'pages' => $pages,
            'language' => $language,
        ]);
    }
}
