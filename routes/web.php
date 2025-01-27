<?php

use App\Models\Language;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\CalendarController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\ProductController;


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
Route::redirect('/ajans/sosyal-medya-yonetimi/41', '/izmir-ajans/sosyal-medya', 301);
Route::redirect('/ajans/ozgun-icerik-yazarligi/43', '/hizmet/google-seo/seo-icerik-uretimi', 301);
Route::redirect('/makale/google-map-isletme-kaydi-nasil-yapilir/24', '/blog/yerel-seo-icin-google-haritalar-nasil-optimize-edilir', 301);
Route::redirect('/ajans/alisveris-e-ticaret-sitesi/45', '/hizmet/web-tasarim/e-ticaret-sitesi', 301);
Route::redirect('/makale/sanal-pos-basvurusu-icin-gerekli-evraklar/49', '/blog/2025-iyzico-sanal-pos-basvuru-nasil-yapilir', 301);
Route::redirect('/ajans/google-seo-cozumleri/42', '/izmir-ajans/google-seo', 301);
Route::redirect('/makale/paytr-ile-sitenizden-kolayca-odeme-alin/104', '/blog/2025-paytr-sanal-pos-basvuru-nasil-yapilir', 301);
Route::redirect('/makale/izmir-de-uygun-fiyatli-web-tasarim-hizmeti-sunuyoruz/96', '/blog/2025-izmir-internet-sitesi-yaptirma-fiyatlari', 301);
Route::redirect('/makale/seo-icin-yapmaniz-gereken-10-ana-madde/64', '/blog/googleda-seo-ile-ust-siralara-cikmanin-sirlari', 301);
Route::redirect('/makale/eski-foca-ve-yeni-foca-web-tasarim-firmalari-hakkinda/99', '/blog/izmirde-web-tasarim-yapan-ajanslar', 301);
Route::redirect('/makale/google-haritalardaki-sahte-konumlar/48', '/blog/google-haritalarina-firmanizi-eklemenizin-onemi', 301);
Route::redirect('/makale/izmir-bayrakli-folkart-towers-ofisi-hizmetinizde/50', '/iletisim', 301);

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

// Varyasyonlu ürün route'ları
