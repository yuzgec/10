<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Browsershot\Browsershot;
use Spatie\TranslationLoader\LanguageLine;
use CyrildeWit\EloquentViewable\Support\Period;
use CyrildeWit\EloquentViewable\Contracts\Views;


class HomeController extends Controller
{
    public function index(){

/*         Browsershot::url('https://www.godijital.net')
        ->windowSize(1920, 1080)
        ->save(public_path('/storage/desktop.jpg'));

        Browsershot::url('https://www.godijital.net')
        ->device('iPhone X')
        ->save(public_path('/storage/mobile.jpg')); */

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

        return view('frontend.service.detail',compact('detail'));
        //$Count = views($detail)->unique()->period(Period::create(Carbon::today()))->count();
    }

    public function category($slug){

        $detail = Category::whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        views($detail)->cooldown(60)->record();

        return view('frontend.category.detail',compact('detail'));
       
    }

    public function page($slug){
        $detail = Page::with(['getCategory'])->whereHas('translations', function ($query) use ($slug){
            $query->where('slug', $slug);
        })->first();

        //dd($detail);


        views($detail)->cooldown(60)->collection(config('app.locale'))->record();


        return view('frontend.page.detail',compact('detail'));
    }


    public function phone(){
        return view('phone');
    } 

    

}
