<?php

use App\Models\Language;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\CalendarController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Backend\PermissionController;


Route::redirect('/hakkimizda', '/kurumsal/hakkimizda', 301);
Route::redirect('/isler', '/projeler', 301);
Route::redirect('/izmir-karsiyaka', '/iletisim', 301);
Route::redirect('/ajans/web-tasarim-hizmeti/39', '/izmir-ajans/web-tasarim', 301);
Route::redirect('/makale/izmir-karsiyaka-da-seo-yapan-firmalar/46', '/blog/izmirde-web-tasarim-yapan-ajanslar', 301);
Route::redirect('/makale/instagram-firma-hesabi-nasil-yapilir/27', '/blog/instagram-algoritmasi-nasil-calisir-etkilesiminizi-artirmanin-yollari', 301);
Route::redirect('/makale/google-haritalarda-posta-ile-onay-sureci/92', '/blog/google-haritalarina-firmanizi-eklemenizin-onemi', 301);
Route::redirect('/makale/web-sitemi-benim-bir-arkadasim-yapiyor/39', '/blog/kartvizitiniz-degil-bir-internet-siteniz-olsun', 301);
Route::redirect('/makale/izmir-deki-web-tasarim-ajanslari/22', '/blog/izmirde-web-tasarim-yapan-ajanslar', 301);
Route::redirect('/makale/domain-ne-kadar-sure-sonra-duser/40', '/blog/domain-sure-bitiminden-sonra-ne-olur-cezai-bir-islem-var-midir', 301);
Route::redirect('/makale/internet-sitelerinizi-duzenli-olarak-guncelliyor-musunuz/93', '/blog/internet-sitenizi-duzenli-olarak-guncelliyor-musunuz', 301);
Route::redirect('/makale/google-reklamlari-ile-firmanizi-ilk-adim-oteye-tasiyin/65', '/hizmet/dijital-reklam/google-reklamlari', 301);

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');


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

require __DIR__.'/backend.php';
require __DIR__.'/auth.php';