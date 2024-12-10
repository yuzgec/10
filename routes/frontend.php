<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/iletisim', [HomeController::class, 'contactus'])->name('contactus');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/markalar', [HomeController::class, 'brands'])->name('brands');
Route::get('/teklif-al', [HomeController::class, 'offer'])->name('offer');
Route::get('/odeme-yap', [HomeController::class, 'payment'])->name('payment');
Route::get('/projeler', [HomeController::class, 'projects'])->name('projects');
Route::get('/kurumsal/{url}', [HomeController::class, 'page'])->name('page.detail');
Route::get('/izmir-ajans/{url}', [HomeController::class, 'category'])->name('category.detail');

Route::get('/hizmetler', [HomeController::class, 'services'])->name('services');
Route::get('/hizmet/{url}', [HomeController::class, 'service'])->name('service.detail');

Route::get('/blog', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog/{url}', [HomeController::class, 'blog'])->name('blog.detail');

Route::post('/analysis', [HomeController::class, 'analysis'])->name('analysis');
Route::get('/site-analiz-sonuc', [HomeController::class, 'analysis.result']);
