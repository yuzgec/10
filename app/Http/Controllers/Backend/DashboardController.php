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
use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use App\Services\ViewService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index(){

        $analysis = Analysis::all();
        
        $mostViewedPages = app(ViewService::class)->getMostViewedPages();

        // Döviz kurlarını al
       

        $counts = Cache::remember('counts', now()->addYear(5), function () {
            return [
                'pages' => Page::count(),
                'services' => Service::count(),
                'blogs' => Blog::count(),
                'faqs' => Faq::count(),
                'categories' => Category::count(),
                'teams' => Team::count()
            ];
        });

        return view('backend.index', compact('analysis', 'counts', 'mostViewedPages'));
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

    public function activities()
    {
        $activities = Activity::with('causer', 'subject')
            ->latest()
            ->paginate(50);

        return view('backend.dashboard.activities', compact('activities'));
    }

    public function deleteActivity($id)
    {
        try {
            $activity = Activity::findOrFail($id);
            $activity->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Aktivite kaydı başarıyla silindi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Aktivite silinirken bir hata oluştu'
            ], 500);
        }
    }
}
