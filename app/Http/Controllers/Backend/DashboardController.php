<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Team;
use App\Models\Video;
use App\Models\Product;
use App\Models\Service;
use App\Models\Analysis;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ViewService;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
                'productCategories' => ProductCategory::count(),
                'teams' => Team::count(),
                'videos' => Video::count(),
            ];
        });

        return view('backend.index',compact('analysis','counts','mostViewedPages'));
    }

    public function gallerysort(Request $request)
    {
        $order = $request->input('order'); // Array of media IDs in new order

        dd($order);

        foreach ($order as $index => $id) {
            Media::where('id', $id)->update(['order_column' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
