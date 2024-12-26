<?php

namespace App\Http\Controllers\Backend;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index()
    {

        $all = Video::with(['getCategory', 'media'])
        ->lang()
        ->when(request('q'), function ($query, $q) {
            $query->whereTranslationLike('name', "%{$q}%")
                  ->orWhereTranslationLike('videoCode', "%{$q}%");
        })
        ->when(request('category_id'), function($query){
            $query->where('category_id', request('category_id'));
        })
        ->rank()
        ->paginate(20);

        //Debugbar::info($all);


        $topPages = Video::orderByViews()->take(10)->get();

        $chartData = [
            'labels' => $topPages->pluck('name'), // Sayfa başlıklarını al
            'views' => $topPages->pluck('views_count'), // Görüntülenme sayılarını al
        ];

        //$parent = Category::where('slug', 'video')->first();



        return view('backend.video.index',compact('all','chartData'));
    }
}
