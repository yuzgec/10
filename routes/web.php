<?php

use App\Models\Language;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\CalendarController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::redirect('/hakkimizda', '/kurumsal/hakkimizda', 301);
Route::redirect('/isler', '/projeler', 301);
Route::redirect('/izmir-karsiyaka', '/iletisim', 301);
Route::redirect('/makale/izmir-karsiyaka-da-seo-yapan-firmalar/46', '/blog/izmirde-web-tasarim-yapan-ajanslar', 301);


Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
Route::get('/calendar/create', [CalendarController::class, 'create'])->name('calendar.create');
Route::post('/calendar', [CalendarController::class, 'store'])->name('calendar.store');
Route::delete('/calendar/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
Route::get('/calendar/events', [CalendarController::class, 'fetchEvents'])->name('calendar.events');

$selectLang = Language::active()->get()->count();

if($selectLang == 1){
     require __DIR__.'/frontend.php';

}else{

    Route::group(
        ['prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
        function(){

            require __DIR__.'/frontend.php';
            //require __DIR__.'/redirect.php';
    
    });

}

//Frontend


require __DIR__.'/backend.php';
require __DIR__.'/auth.php';