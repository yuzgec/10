<?php 

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\WorkFlowController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TranslationController;
use App\Http\Controllers\Backend\CustomerWorkController;
use App\Http\Controllers\Backend\CustomerOfferController;


//Backend
Route::get('/go',[DashboardController::class, 'index'])->name('go');
Route::auto('/user',UserController::class);
Route::get('/go/activity', [UserController::class,'activity'])->name('activity');
Route::resource('/go/role',RoleController::class);

Route::resource('/go/customer',CustomerController::class);
Route::resource('/go/offer',CustomerOfferController::class);
Route::resource('/go/works',CustomerWorkController::class);


Route::auto('/page',PageController::class);
Route::get('/go/page-trash',[PageController::class,'trash'])->name('page.trash');
Route::get('/restore/{id}', [PageController::class, 'restore'])->name('page.restore');
Route::resource('/go/service',ServiceController::class);
Route::get('/go/service-trash',[ServiceController::class,'trash'])->name('service.trash');
Route::get('/restore/{id}', [ServiceController::class, 'restore'])->name('service.restore');

Route::resource('/go/category',CategoryController::class);
Route::resource('/go/blog',BlogController::class);
Route::resource('/go/faq',FaqController::class);
Route::resource('/go/product',ProductController::class);
Route::resource('/go/language',LanguageController::class);
Route::resource('/go/settings',SettingController::class);

Route::get('/customer/export', [CustomerController::class, 'export'])->name('customer.export');


Route::resource('/go/workflow', WorkFlowController::class);
Route::resource('/go/translation', TranslationController::class);


