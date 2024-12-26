<?php 

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CalendarController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Backend\WorkFlowController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\Backend\TranslationController;
use App\Http\Controllers\Backend\CustomerWorkController;
use App\Http\Controllers\Backend\CustomerOfferController;


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//Backend
Route::group(["prefix"=>"go", 'middleware' => ['auth','web','go-access']],function() {
    Route::get('/',[DashboardController::class, 'index'])->name('go');

    Route::group(["prefix"=>"site", 'middleware' => ['auth','web','go-access']],function() {
        Route::auto('/category',CategoryController::class);
        Route::auto('/blog',BlogController::class);
        Route::auto('/video',VideoController::class);
        Route::auto('/faq',FaqController::class);
        Route::auto('/service',ServiceController::class);
        Route::get('/service-trash',[ServiceController::class,'trash'])->name('service.trash');
        Route::get('/restore/{id}', [ServiceController::class, 'restore'])->name('service.restore');
        Route::auto('/page',PageController::class);
        Route::auto('/team',TeamController::class);
        Route::get('/page-trash',[PageController::class,'trash'])->name('page.trash');
        Route::get('/restore/{id}', [PageController::class, 'restore'])->name('page.restore');
    });

    Route::group(["prefix"=>"crm", 'middleware' => ['auth','web','go-access']],function() {
        Route::resource('/customer',CustomerController::class);
        Route::resource('/offer',CustomerOfferController::class);
        Route::resource('/works',CustomerWorkController::class);
        Route::auto('/workflow', WorkFlowController::class);
        Route::get('/customer/export', [CustomerController::class, 'export'])->name('customer.export');


    });

    Route::group(["prefix"=>"user", 'middleware' => ['auth','web','go-access']],function() {
        Route::auto('/user',UserController::class);
        Route::get('/activity', [UserController::class,'activity'])->name('activity');
        Route::resource('/role',RoleController::class);
        Route::resource('permission', PermissionController::class)->except(['show', 'edit', 'update']);
        Route::post('permission/assign', [PermissionController::class, 'assignPermission'])->name('permission.assign');
        Route::get('permission/role/{roleName}', [PermissionController::class, 'getRolePermissions'])->name('permission.getRolePermissions');
    });

    Route::group(["prefix"=>"settings", 'middleware' => ['auth','web','go-access']],function() {
        Route::auto('/translation', TranslationController::class);
        Route::auto('/language',LanguageController::class);
        Route::auto('/settings',SettingController::class);

    });

    Route::group(["prefix"=>"shop", 'middleware' => ['auth','web','go-access']],function() {
        Route::auto('/product',ProductController::class);

    });
    
});

