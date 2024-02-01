<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordForgetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCatController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\OfferContentController;
use App\Http\Controllers\Backend\ReviewManageController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\Backend\IncludeAnotherController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login forgot password route part 
Route::middleware('guest')->group(function () {
    Route::get('forget/password', [PasswordForgetController::class, 'forgetPassword'])->name('forget.password');
    Route::post('reset/password', [PasswordForgetController::class, 'resetPassword'])->name('reset.password.email');
    Route::get('reset_password/{token}', [PasswordForgetController::class, 'setPassword'])->name('reset.password.token');
    Route::post('password/update/{token}', [PasswordForgetController::class, 'updatePassword'])->name('update.password.token');
});




// Route::post('/admin/profile/update/{id}', 'profileUpdate')->name('admin.profile.update');

// user profile setting 
Route::middleware('auth')->group(function () {
    Route::post('/admin/profile/update/{id}', [DashboardController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::post('/admin/siteInfo/update/{id}', [DashboardController::class, 'siteInfoUpdate'])->name('admin.siteInfo.update');
    Route::get('/admin/password/change', [DashboardController::class, 'changePassword'])->name('admin.password.change');
    Route::post('/admin/password/update/{id}', [DashboardController::class, 'updatePassword'])->name('admin.password.update');
});
//************/ backend Route start ***************


Route::middleware('auth','role:Admin')->group(function () {
 
    // dashboard route part controller group------- 01
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        Route::get('/admin/logout', 'logout')->name('admin.logout');
        Route::get('/admin/profile', 'profile')->name('admin.profile');
    });

    // category route part controller group----- 02
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/create/catagory', 'index')->name('create.catagory');
        Route::post('/store/catagory', 'store')->name('store.catagory');
        Route::get('/show/catagory', 'show')->name('show.catagory');
        Route::get('/destroy/catagory/{id}', 'destroy')->name('destroy.catagory');
        Route::get('/edit/catagory/{id}', 'edit')->name('edit.catagory');
        Route::post('/update/catagory/{id}', 'update')->name('update.catagory');
        Route::get('/status/catagory/{id}', 'changestatus')->name('status.catagory');
    });

    // sub category route part controller group----- 03 
    Route::controller(SubCatController::class)->group(function () {
        Route::get('/create/subcatagory', 'index')->name('create.subcatagory');
        Route::post('/store/subcatagory', 'store')->name('store.subcatagory');
        Route::get('/show/subcatagory', 'show')->name('show.subcatagory');
        Route::get('/destroy/subcatagory/{id}', 'destroy')->name('destroy.subcatagory');
        Route::get('/edit/subcatagory/{id}', 'edit')->name('edit.subcatagory');
        Route::post('/update/subcatagory/{id}', 'update')->name('update.subcatagory');
        Route::get('/status/subcatagory/{id}', 'changestatus')->name('status.subcatagory');
    });

    // Brand route part controller group----- 04
    Route::controller(BrandController::class)->group(function () {
        Route::get('/create/brand', 'index')->name('create.brand');
        Route::post('/store/brand', 'store')->name('store.brand');
        Route::get('/show/brand', 'show')->name('show.brand');
        Route::get('/destroy/brand/{id}', 'destroy')->name('destroy.brand');
        Route::get('/edit/brand/{id}', 'edit')->name('edit.brand');
        Route::post('/update/brand/{id}', 'update')->name('update.brand');
        Route::get('/status/brand/{id}', 'changestatus')->name('status.brand');
    });

    // Size route part controller group----- 05
    Route::controller(SizeController::class)->group(function () {
        Route::get('/create/size', 'index')->name('create.size');
        Route::post('/store/size', 'store')->name('store.size');
        Route::get('/show/size', 'show')->name('show.size');
        Route::get('/destroy/size/{id}', 'destroy')->name('destroy.size');
        Route::get('/edit/size/{id}', 'edit')->name('edit.size');
        Route::post('/update/size/{id}', 'update')->name('update.size');
        Route::get('/status/size/{id}', 'changestatus')->name('status.size');
    
    // kg  route part 
        Route::post('/store/size/kg', 'kgstore')->name('store.size.kg');
        Route::get('/destroy/size/kg/{id}', 'kgdestroy')->name('destroy.size.kg');
        Route::get('/edit/size/kg/{id}', 'kgedit')->name('edit.size.kg');
        Route::post('/update/size/kg/{id}', 'kgupdate')->name('update.size.kg');
        Route::get('/status/size/kg/{id}', 'kgchangestatus')->name('status.size.kg');
    });

    // Color route part controller group----- 06
    Route::controller(ColorController::class)->group(function () {
        Route::get('/create/color', 'index')->name('create.color');
        Route::post('/store/color', 'store')->name('store.color');
        Route::get('/show/color', 'show')->name('show.color');
        Route::get('/destroy/color/{id}', 'destroy')->name('destroy.color');
        Route::get('/edit/color/{id}', 'edit')->name('edit.color');
        Route::post('/update/color/{id}', 'update')->name('update.color');
        Route::get('/status/color/{id}', 'changestatus')->name('status.color');
    });


    // Product route part controller group----- 07
    Route::controller(ProductController::class)->group(function () {
        Route::get('/create/product', 'index')->name('create.product');
        Route::post('/store/product', 'store')->name('store.product');
        Route::get('/show/product', 'show')->name('show.product');
        Route::get('/destroy/product/{id}', 'destroy')->name('destroy.product');
        Route::get('/edit/product/{id}', 'edit')->name('edit.product');
        Route::post('/update/product/{id}', 'update')->name('update.product');
        Route::get('/status/product/{id}', 'changestatus')->name('status.product');
    });

    // Product order route part controller group----- 08
    Route::controller(OrderController::class)->group(function () {
        Route::get('/order/product', 'index')->name('order.product');
        Route::get('/order/product/details/{id}', 'orderFullDetails')->name('order.product.details');
        Route::get('/order/product/details/delete/{id}', 'orderFullDetailsDelete')->name('order.product.details.delete');
        Route::get('/order/order/invoice/{id}', 'orderInvoice')->name('order.order.invoice');
        Route::post('/order/order/status/update/{id}', 'orderStatusUpdate')->name('order.status.update');
    });

    // Role and Permission route part controller group----- 09
    Route::controller(RolePermissionController::class)->group(function () {
        Route::get('/role/permission/create', 'index')->name('role.permission.create');
        Route::post('/role/permission/store', 'store')->name('role.permission.store');
        Route::get('/role/permission/manage', 'rolePermissionManage')->name('role.permission.manage');
        Route::get('/role/permission/edit/{id}', 'rolePermissionEdit')->name('role.permission.edit');
        Route::post('/role/permission/update/{id}', 'rolePermissionUpdate')->name('role.permission.update');
        Route::get('/role/permission/delete/{id}', 'rolePermissionDelete')->name('role.permission.delete');

    });

    // user route part controller group----- 10
    Route::controller(UserController::class)->group(function () {
        Route::get('/user/create', 'index')->name('user.create');
        Route::post('/user/store', 'store')->name('user.store');
        Route::get('/user/manage', 'userManage')->name('user.manage');
        Route::get('/user/edit/{id}', 'userEdit')->name('user.edit');
        Route::post('/user/update/{id}', 'userUpdate')->name('user.update');
        Route::get('/user/delete/{id}', 'userDelete')->name('user.delete');

    });

    // AnotherInclude route part controller group----- 11
    Route::controller(IncludeAnotherController::class)->group(function () {
        Route::get('/include/another/create', 'index')->name('include.another.create');
        Route::post('/include/another/{id}', 'update')->name('include.another.update');

    });

    // Offer content route part controller group----- 12
    Route::controller(OfferContentController::class)->group(function () {
        Route::get('offer/content/create', 'index')->name('offer.content');
        Route::post('offer/content/store', 'store')->name('offer.content.store');
        Route::post('offer/content/update', 'update')->name('offer.content.update');

    });
    // product review manage route part controller group----- 13
    Route::controller(ReviewManageController::class)->group(function () {
        Route::get('product/review/show/all', 'index')->name('review.show.all');
        Route::get('product/review/delete/{id}', 'destroy')->name('review.destroy');
        Route::get('view/single/product/review/{id}', 'viewsingleproduct')->name('review.single.product');

    });


});
//************ backend Route end ***************




require __DIR__.'/auth.php';

include('ecommerceFrontend.php');
