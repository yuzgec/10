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
 
        SEOMeta::setTitle('Google SEO Uzmanı');
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.index');
    }

    public function contactus(){
        SEOMeta::setTitle('İletişim | Google SEO ve Reklamları');
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());
        return view('frontend.page.contactus');
    }

    public function offer(){

        SEOMeta::setTitle('Teklif Al | Google SEO Uzmanı');
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());


        return view('frontend.page.offer');
    }

    public function brands(){

        SEOMeta::setTitle('Çalıştığımız Markalar | Google SEO Uzmanı');
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());


        return view('frontend.page.brands');
    }

    public function blogs(){

        SEOMeta::setTitle('Blog | Google SEO Uzmanı');
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.blog.index');
    }

    public function projects(){

        SEOMeta::setTitle('Çalışmalarımız | Google SEO Uzmanı');
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.project.index');
    }

    public function service($category, $slug){
        
        $detail = Service::with(['getCategory'])->whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        if (!$detail) {
            abort(404);
        }

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

        if (!$detail) {
            abort(404);
        }

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

        if (!$detail) {
            abort(404);
        }

        views($detail)->cooldown(60)->collection(config('app.locale'))->record();

        SEOMeta::setTitle($detail->name);
        SEOMeta::setDescription('GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir dijital ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.page.detail',compact('detail'));
    }

    public function blog($slug){

        $detail = Blog::with(['getCategory'])->whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        if (!$detail) {
            abort(404);
        }

        views($detail)->cooldown(60)->collection(config('app.locale'))->record();

        $t = preg_replace('/([,\?:])/', "$1\n", $detail->name); // İşaretlerden sonra \n ekle
        $title = nl2br($t);

        SEOMeta::setTitle($detail->name.' - '. $detail->getCategory->name);
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.blog.detail',compact('detail','title'));
    }

    public function blogCategory($slug){

        $category = Category::whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        if (!$category) {
            abort(404);
        }

        $all = Blog::with(['getCategory'])->whereHas('translations', function ($query) use ($category){
            $query->where('category_id', $category->id);
        })->get();

        SEOMeta::setTitle($category->name);
        SEOMeta::setDescription('İzmir GO Dijital web tasarım, sosyal medya ve google seo optimizasyonu alanlarında hizmet veren bir ajanstır.');
        SEOMeta::setCanonical(url()->full());

        return view('frontend.blog.blog-category',compact('all', 'category'));

    }  

}