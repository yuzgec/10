<?php 

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\LogController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\RedirectController;
use App\Http\Controllers\Backend\WorkFlowController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\TranslationController;
use App\Http\Controllers\Backend\CustomerWorkController;
use App\Http\Controllers\Backend\CustomerOfferController;


Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(["prefix"=>"go", 'middleware' => ['auth','web','go-access']],function() {
    
    Route::get('/',[DashboardController::class, 'index'])->name('go');
    Route::post('/media/delete', [MediaController::class, 'delete'])->name('media.delete');
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    Route::post('/logs/clear', [LogController::class, 'clear'])->name('logs.clear');

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
        Route::resource('/customer',CustomerController::class);
        Route::resource('/offer',CustomerOfferController::class);
        Route::resource('/works',CustomerWorkController::class);
        Route::auto('/workflow', WorkFlowController::class);
        Route::get('/customer/export', [CustomerController::class, 'export'])->name('customer.export');
        Route::get('/districts/{city}', [CustomerController::class,'getDistricts']);
    });

    Route::group(["prefix"=>"user"],function() {
        Route::auto('/user',UserController::class);
        Route::get('/activity', [UserController::class,'activity'])->name('activity');
        Route::resource('/role',RoleController::class);
        Route::resource('permission', PermissionController::class)->except(['show', 'edit', 'update']);
        Route::post('permission/assign', [PermissionController::class, 'assignPermission'])->name('permission.assign');
        Route::get('permission/role/{roleName}', [PermissionController::class, 'getRolePermissions'])->name('permission.getRolePermissions');
    });

    Route::group(["prefix"=>"settings"],function() {
        Route::auto('/translation', TranslationController::class);
        Route::auto('/language',LanguageController::class);
        Route::auto('/settings',SettingController::class);
        Route::resource('/redirects', RedirectController::class)->only(['index', 'store', 'destroy']);
    });

    Route::group(["prefix"=>"shop"],function() {
        Route::auto('/product',ProductController::class);

    });

    
});

