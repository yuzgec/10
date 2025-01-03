<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnalysisController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/iletisim', [HomeController::class, 'contactus'])->name('contactus');
Route::get('/markalar', [HomeController::class, 'brands'])->name('brands');
Route::get('/teklif-al', [HomeController::class, 'offer'])->name('offer');
Route::get('/odeme-yap', [HomeController::class, 'payment'])->name('payment');
Route::get('/projeler', [HomeController::class, 'projects'])->name('projects');
Route::get('/kurumsal/{url}', [HomeController::class, 'page'])->name('page.detail');

Route::get('/izmir-ajans/{url}', [HomeController::class, 'category'])->name('category.detail');

Route::get('/hizmetler', [HomeController::class, 'services'])->name('services');
Route::get('/hizmet/{c}/{url}', [HomeController::class, 'service'])->name('service.detail');

Route::get('/bloglar', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog-kategori/{url}', [HomeController::class, 'blogCategory'])->name('blog.category');
Route::get('/blog/{url}', [HomeController::class, 'blog'])->name('blog.detail');

Route::get('/ekip/{url}', [HomeController::class, 'team'])->name('team.detail');

Route::post('/analysis', [AnalysisController::class, 'store'])->name('analysis.store');
Route::get('/analysis/{id}', [AnalysisController::class, 'show'])->name('analysis.show');