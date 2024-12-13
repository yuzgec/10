<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Page;
use App\Models\User;
use App\Models\Service;
use App\Models\Analysis;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Browsershot\Browsershot;
use Artesaos\SEOTools\Facades\SEOMeta;
use Spatie\TranslationLoader\LanguageLine;
use CyrildeWit\EloquentViewable\Support\Period;
use CyrildeWit\EloquentViewable\Contracts\Views;


class HomeController extends Controller
{
    public function index(){

        SEOMeta::setTitle('İzmir Foça Web Tasarım | Google SEO Uzmanı');
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.index');
    }

    public function contactus(){


        SEOMeta::setTitle('İzmir GO Dijital İletişim | Web tasarım, Google SEO ve Reklamları | Sosyal Medya');
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.page.contactus');
    }

    public function offer(){
        return view('frontend.page.offer');
    }

    public function brands(){
        return view('frontend.page.brands');
    }

    public function blogs(){
        return view('frontend.blog.index');
    }

    public function projects(){

        return view('frontend.project.index');
    }

    public function service($slug){

        $detail = Service::with(['getCategory'])->whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        views($detail)->cooldown(60)->collection(config('app.locale'))->record();

        SEOMeta::setTitle('İzmir '.$detail->name.' '. $detail->getCategory->name);
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.service.detail',compact('detail'));
    }

    public function category($slug){

        $detail = Category::whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        views($detail)->cooldown(60)->collection(config('app.locale'))->record();


        SEOMeta::setTitle('İzmir '.$detail->name);
        SEOMeta::setDescription('GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir dijital ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.category.detail',compact('detail'));
       
    }

    public function page($slug){
        $detail = Page::with(['getCategory'])->whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();


        views($detail)->cooldown(60)->collection(config('app.locale'))->record();

        SEOMeta::setTitle('İzmir '.$detail->name);
        SEOMeta::setDescription('GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir dijital ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.page.detail',compact('detail'));
    }

    public function blog($slug){
        $detail = Blog::with(['getCategory'])->whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();


        views($detail)->cooldown(60)->collection(config('app.locale'))->record();

        $t = str_replace(',', "\n", $detail->name);
        $title = nl2br($t); 

        SEOMeta::setTitle('İzmir '.$detail->name.' '. $detail->getCategory->name);
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.blog.detail',compact('detail','title'));
    }

    public function blogCategory($slug){

        $category = Category::whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        $all = Blog::with(['getCategory'])->whereHas('translations', function ($query) use ($category){
            $query->where('category_id', $category->id);
        })->get();

        SEOMeta::setTitle('İzmir '.$category->name);
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır.');
        SEOMeta::setCanonical(url()->full());

        //dd($all);

        return view('frontend.blog.blog-category',compact('all', 'category'));

    }


    public function analysis(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $create = Analysis::create([
            'name' => strip_tags($request->input('name')),
        ]);
        /* 

        $desktop = Browsershot::url($request->name)->windowSize(1920, 1080)->save(public_path('/storage/analysis/desktop.jpg'));
        $mobile = Browsershot::url($request->name)->device('iPhone X')->save(public_path('/storage/mobile.jpg'));
        */
        //return view('frontend.page.analysis',compact('desktop','mobile'));

        return redirect()->route('home');
    }

}