<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCatController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\SizeController;
use App\Http\Controllers\Backend\ColorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\ShoppingCart;
use App\Http\Controllers\Frontend\ShoppingWishlist;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerDashboardController;
use App\Http\Controllers\Frontend\SocialController;


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



// user dashboard route
Route::get('/dashboard', [HomeController::class, 'userDashborad'])->middleware(['auth','role:User', 'verified'])->name('dashboard');
Route::get('/customer/order/invoice/{id}', [HomeController::class, 'orderinvoice'])->middleware('auth')->name('order.invoice');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// frontend controller start 
Route::get('/', [HomeController::class, 'index'])->name('frontend_site');
// search route start 
Route::get('/product/search', [HomeController::class, 'productSearch'])->name('product.search');
// search route end 
Route::get('/single/product/{id}', [HomeController::class, 'singleProduct'])->name('single.product');
Route::get('/show/category/product/{id}', [HomeController::class, 'categoryProduct'])->name('show.category.product');
Route::get('/show/subcategory/product/{id}', [HomeController::class, 'subcategoryProduct'])->name('show.subcategory.product');
Route::get('/show/all/product', [HomeController::class, 'allProduct'])->name('show.all.product');

// shoping cart part
Route::post('/product/add-to-cart', [ShoppingCart::class, 'addToCart'])->name('product.add_to_cart');
Route::get('/product/add-to-cart-delete/{id}', [ShoppingCart::class, 'addToCartDelete'])->name('product.add_to_cart-delete');
// social login route 

Route::get('/socialite/create', [SocialController::class, 'create'])->name('socialite.create');
Route::get('/sociallogin/store', [SocialController::class, 'login'])->name('socialite.login');
Route::post('/sociallogin/setpass/{sid}', [SocialController::class, 'setpass'])->name('socialite.setpass');
// product checkout part
Route::middleware('auth')->group(function () {
Route::get('/product/checkout', [CheckoutController::class, 'index'])->name('product.checkout');
Route::post('/product/shipping/details', [CheckoutController::class, 'shippingDetails'])->name('product.shipping.details');
Route::get('/product/payment', [CheckoutController::class, 'payment'])->name('product.payment');
Route::post('/product/place_order', [CheckoutController::class, 'placeOrder'])->name('product.placeOrder');
Route::get('/user/logout', [CustomerDashboardController::class, 'logout'])->name('user.logout');

// cart wishlist route
Route::post('/product/add-to-wishlist', [ShoppingWishlist::class, 'addToWishlist'])->name('product.add_to_wishlist');
Route::get('/product/add-to-wishlist-delete/{id}', [ShoppingWishlist::class, 'addToWishlistDelete'])->name('product.add_to_wishlist-delete');

});


// user profile setting 
Route::middleware('auth')->group(function () {
Route::post('/admin/profile/update/{id}', [DashboardController::class, 'profileUpdate'])->name('admin.profile.update');
Route::post('/admin/siteInfo/update/{id}', [DashboardController::class, 'siteInfoUpdate'])->name('admin.siteInfo.update');
Route::get('/admin/password/change', [DashboardController::class, 'changePassword'])->name('admin.password.change');
Route::post('/admin/password/update/{id}', [DashboardController::class, 'updatePassword'])->name('admin.password.update');
});


// ***************end frontend route **************
// Route::post('/admin/profile/update/{id}', 'profileUpdate')->name('admin.profile.update');

// backend controller start 
Route::middleware('auth','role:Admin')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        Route::get('/admin/logout', 'logout')->name('admin.logout');
        Route::get('/admin/profile', 'profile')->name('admin.profile');
    });

    // category route part -------------
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/create/catagory', 'index')->name('create.catagory');
        Route::post('/store/catagory', 'store')->name('store.catagory');
        Route::get('/show/catagory', 'show')->name('show.catagory');
        Route::get('/destroy/catagory/{id}', 'destroy')->name('destroy.catagory');
        Route::get('/edit/catagory/{id}', 'edit')->name('edit.catagory');
        Route::post('/update/catagory/{id}', 'update')->name('update.catagory');
        Route::get('/status/catagory/{id}', 'changestatus')->name('status.catagory');
    });

    // sub category route part-------------------- 
    Route::controller(SubCatController::class)->group(function () {
        Route::get('/create/subcatagory', 'index')->name('create.subcatagory');
        Route::post('/store/subcatagory', 'store')->name('store.subcatagory');
        Route::get('/show/subcatagory', 'show')->name('show.subcatagory');
        Route::get('/destroy/subcatagory/{id}', 'destroy')->name('destroy.subcatagory');
        Route::get('/edit/subcatagory/{id}', 'edit')->name('edit.subcatagory');
        Route::post('/update/subcatagory/{id}', 'update')->name('update.subcatagory');
        Route::get('/status/subcatagory/{id}', 'changestatus')->name('status.subcatagory');
    });

    // Brand route part -------------
    Route::controller(BrandController::class)->group(function () {
        Route::get('/create/brand', 'index')->name('create.brand');
        Route::post('/store/brand', 'store')->name('store.brand');
        Route::get('/show/brand', 'show')->name('show.brand');
        Route::get('/destroy/brand/{id}', 'destroy')->name('destroy.brand');
        Route::get('/edit/brand/{id}', 'edit')->name('edit.brand');
        Route::post('/update/brand/{id}', 'update')->name('update.brand');
        Route::get('/status/brand/{id}', 'changestatus')->name('status.brand');
    });
    // Unit route part -------------
    Route::controller(UnitController::class)->group(function () {
        Route::get('/create/unit', 'index')->name('create.unit');
        Route::post('/store/unit', 'store')->name('store.unit');
        Route::get('/show/unit', 'show')->name('show.unit');
        Route::get('/destroy/unit/{id}', 'destroy')->name('destroy.unit');
        Route::get('/edit/unit/{id}', 'edit')->name('edit.unit');
        Route::post('/update/unit/{id}', 'update')->name('update.unit');
        Route::get('/status/unit/{id}', 'changestatus')->name('status.unit');
    });
    // Size route part -------------
    Route::controller(SizeController::class)->group(function () {
        Route::get('/create/size', 'index')->name('create.size');
        Route::post('/store/size', 'store')->name('store.size');
        Route::get('/show/size', 'show')->name('show.size');
        Route::get('/destroy/size/{id}', 'destroy')->name('destroy.size');
        Route::get('/edit/size/{id}', 'edit')->name('edit.size');
        Route::post('/update/size/{id}', 'update')->name('update.size');
        Route::get('/status/size/{id}', 'changestatus')->name('status.size');
    });
    // Color route part -------------
    Route::controller(ColorController::class)->group(function () {
        Route::get('/create/color', 'index')->name('create.color');
        Route::post('/store/color', 'store')->name('store.color');
        Route::get('/show/color', 'show')->name('show.color');
        Route::get('/destroy/color/{id}', 'destroy')->name('destroy.color');
        Route::get('/edit/color/{id}', 'edit')->name('edit.color');
        Route::post('/update/color/{id}', 'update')->name('update.color');
        Route::get('/status/color/{id}', 'changestatus')->name('status.color');
    });


    // Product route part -------------
    Route::controller(ProductController::class)->group(function () {
        Route::get('/create/product', 'index')->name('create.product');
        Route::post('/store/product', 'store')->name('store.product');
        Route::get('/show/product', 'show')->name('show.product');
        Route::get('/destroy/product/{id}', 'destroy')->name('destroy.product');
        Route::get('/edit/product/{id}', 'edit')->name('edit.product');
        Route::post('/update/product/{id}', 'update')->name('update.product');
        Route::get('/status/product/{id}', 'changestatus')->name('status.product');
    });
    // Product order route part -------------
    Route::controller(OrderController::class)->group(function () {
        Route::get('/order/product', 'index')->name('order.product');
        Route::get('/order/product/details/{id}', 'orderFullDetails')->name('order.product.details');
        Route::get('/order/product/details/delete/{id}', 'orderFullDetailsDelete')->name('order.product.details.delete');
        Route::get('/order/order/invoice/{id}', 'orderInvoice')->name('order.order.invoice');
        Route::post('/order/order/status/update/{id}', 'orderStatusUpdate')->name('order.status.update');
    });

});


require __DIR__.'/auth.php';
