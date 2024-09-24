<?php

use App\Models\Language;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


//Frontend
Route::group(
    ['prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function(){

        //require __DIR__.'/redirect.php';

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/iletisim', [HomeController::class, 'contactus'])->name('contactus');
        Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
        Route::get('/markalar', [HomeController::class, 'brands'])->name('brands');
        Route::get('/teklif-al', [HomeController::class, 'offer'])->name('offer');
        Route::get('/odeme-yap', [HomeController::class, 'payment'])->name('payment');
        Route::get('/projeler', [HomeController::class, 'projects'])->name('projects');
        Route::get(__('site.sayfa').'/{url}', [HomeController::class, 'page'])->name('page.detail');
        Route::get(__('site.hizmet').'/{url}', [HomeController::class, 'service'])->name('service.detail');
        Route::get('/hizmetler', [HomeController::class, 'services'])->name('services');
        Route::get('/blog', [HomeController::class, 'blogs'])->name('blogs');
        Route::get('/blog/{url}', [HomeController::class, 'blog'])->name('blog');
    });

require __DIR__.'/backend.php';
require __DIR__.'/auth.php';