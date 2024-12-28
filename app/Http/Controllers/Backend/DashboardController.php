<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Team;
use App\Models\Video;
use App\Models\Service;
use App\Models\Analysis;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ViewService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index(){

        $analysis = Analysis::all();
        $mostViewedPages = app(ViewService::class)->getMostViewedPages();

        //dd($mostViewedPages);

        $counts = Cache::remember('counts', now()->addYear(5), function () {
            return [
                'pages' => Page::count(),
                'services' => Service::count(),
                'blogs' => Blog::count(),
                'faqs' => Faq::count(),
                'categories' => Category::count(),
                'teams' => Team::count(),
                'videos' => Video::count(),
            ];
        });

        return view('backend.index',compact('analysis','counts','mostViewedPages'));
    }
}
