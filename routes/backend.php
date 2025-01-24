<?php 

use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\LogController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\RedirectController;
use App\Http\Controllers\Backend\WorkFlowController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RouteListController;

use App\Http\Controllers\Backend\PermissionController;

use App\Http\Controllers\Backend\TranslationController;
use App\Http\Controllers\Backend\CustomerWorkController;
use App\Http\Controllers\Backend\CustomerOfferController;
use App\Http\Controllers\Backend\OfferTemplateController;
use App\Http\Controllers\Shop\ProductAttributeController;
use App\Http\Controllers\Backend\GoogleCalendarController;
use App\Http\Controllers\Backend\CustomerPaymentController;
use App\Http\Controllers\Shop\ProductAttributeValueController;


Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth','go-access']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(["prefix"=>"go", 'middleware' => ['auth','web','go-access']],function() {
    
    Route::get('/',[DashboardController::class, 'index'])->name('go');
    Route::post('/media/delete', [MediaController::class, 'delete'])->name('media.delete');
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::post('/logs/clear', [LogController::class, 'clear'])->name('logs.clear');
    Route::get('routes', [RouteListController::class, 'index'])->name('route.list');
    Route::get('/activities', [DashboardController::class, 'activities'])->name('activities');
    Route::delete('/activities/clear', [DashboardController::class, 'clearActivities'])->name('dashboard.activities.clear');
    Route::delete('/dashboard/activities/{id}', [DashboardController::class, 'deleteActivity'])->name('dashboard.activities.delete');
    Route::get('cache/clear', function(){
        Artisan::call('cache:clear');
        alert()->html('Başarıyla Temizlendi','<b>Cache</b> başarıyla temizlendi.', 'success');
        return redirect()->back();
    })->name('cache.clear');

    Route::group(["prefix"=>"site"],function() {
        Route::auto('/category',CategoryController::class);
        Route::auto('/blog',BlogController::class);
        Route::auto('/video',VideoController::class);
        Route::auto('/faq',FaqController::class);
        Route::auto('/service',ServiceController::class);
        Route::auto('/page',PageController::class);
        Route::auto('/team',TeamController::class);
        Route::delete('/page/{id}/media', [PageController::class, 'deleteMedia'])->name('page.deleteMedia');
    });

    Route::group(["prefix"=>"crm"],function() {
        Route::get('/customer/districts/{cityId}', [CustomerController::class, 'getDistricts'])->name('customer.districts');
        Route::auto('/customer',CustomerController::class);
        Route::auto('/customer-payments',CustomerPaymentController::class);

        Route::auto('/customer-works',CustomerWorkController::class);
        Route::put('/customer-works/{customerWork}/status', [CustomerWorkController::class, 'updateStatus'])->name('customer-works.update-status');
        Route::get('/customer-works/{customerWork}/calendar', [CustomerWorkController::class, 'calendar'])->name('customer-works.calendar');
        Route::auto('/payments', CustomerPaymentController::class);
        Route::put('/payments/{customerPayment}/status', [CustomerPaymentController::class, 'updateStatus'])->name('customer-payments.update-status');
        Route::auto('/workflow', WorkFlowController::class);
        Route::auto('/customer-offers', CustomerOfferController::class);
        Route::put('/customer-offers/{offer}/status', [CustomerOfferController::class, 'updateStatus'])->name('customer-offers.update-status');
        Route::get('/districts/{city}', [CustomerController::class,'getDistricts']);
        Route::auto('/offer-templates', OfferTemplateController::class);

        Route::get('calendar/connect', [GoogleCalendarController::class, 'connect'])->name('calendar.connect');
        Route::get('calendar/callback', [GoogleCalendarController::class, 'callback'])->name('calendar.callback');
        Route::get('calendar/disconnect', [GoogleCalendarController::class, 'disconnect'])->name('calendar.disconnect');
    });

    Route::prefix('exchange-rates')->group(function () {
        Route::post('convert', [CustomerOfferController::class, 'convertCurrency'])->name('exchange-rates.convert');
        Route::get('current-rate', [CustomerOfferController::class, 'getCurrentRate'])->name('exchange-rates.current-rate');
    });
    

    Route::group(["prefix"=>"user"],function() {
        Route::auto('/user',UserController::class);
        Route::get('/activity', [UserController::class,'activity'])->name('activity');
        Route::auto('/role',RoleController::class);
        Route::auto('permission', PermissionController::class);
        Route::post('permission/assign', [PermissionController::class, 'assignPermission'])->name('permission.assign');
        Route::get('permission/role/{roleName}', [PermissionController::class, 'getRolePermissions'])->name('permission.getRolePermissions');
    });

    Route::group(["prefix"=>"settings"],function() {
        Route::auto('/translation', TranslationController::class);
        Route::auto('/language',LanguageController::class);
        Route::auto('/settings',SettingController::class);
        Route::auto('/redirects', RedirectController::class);
    });

    Route::group(["prefix"=>"shop"],function() {

        Route::auto('tags', TagController::class);
        Route::auto('product', ProductController::class);
        Route::auto('product-attributes', ProductAttributeController::class);
        Route::auto('product-attribute-values', ProductAttributeValueController::class);
        Route::get('tags/{tag}/products', [TagController::class, 'products'])->name('tags.products');
        Route::get('tags/{tag}/blogs', [TagController::class, 'blogs'])->name('tags.blogs');


    
    });


});



