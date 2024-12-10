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
use App\Http\Requests\AnalysisRequest;
use Spatie\TranslationLoader\LanguageLine;
use CyrildeWit\EloquentViewable\Support\Period;
use CyrildeWit\EloquentViewable\Contracts\Views;


class HomeController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function contactus(){
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


        return view('frontend.service.detail',compact('detail'));
    }

    public function category($slug){

        $detail = Category::whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        views($detail)->cooldown(60)->collection(config('app.locale'))->record();

        return view('frontend.category.detail',compact('detail'));
       
    }

    public function page($slug){
        $detail = Page::with(['getCategory'])->whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();


        views($detail)->cooldown(60)->collection(config('app.locale'))->record();


        return view('frontend.page.detail',compact('detail'));
    }

    public function blog($slug){
        $detail = Blog::with(['getCategory'])->whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();


        views($detail)->cooldown(60)->collection(config('app.locale'))->record();

        $count = views($detail)->unique()->count();

        return view('frontend.blog.detail',compact('detail'));
    }

    public function blogCategory($slug){

        $category = Category::whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        $all = Blog::with(['getCategory'])->whereHas('translations', function ($query) use ($category){
            $query->where('category_id', $category->id);
        })->get();

        return view('frontend.blog.blog-category',compact('all', 'category'));

    }


    public function analysis(Request $request){


        // Regex deseni
        //$pattern = '/^(?:https?:\/\/)?(?:www\.)?([a-zA-Z0-9-]+)(?:\.[a-zA-Z]{2,})$/';
        
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
        //dd($matches, $desktop, $mobile);
        //return view('frontend.page.analysis',compact('desktop','mobile'));

        return redirect()->route('home');


    }
    

}
