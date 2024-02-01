<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShoppingCart;
use App\Http\Controllers\Frontend\ShoppingWishlist;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerDashboardController;
use App\Http\Controllers\Frontend\SocialController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\ProductFilterController;




// user dashboard route
Route::get('/dashboard', [HomeController::class, 'userDashborad'])->middleware(['auth','verified','role:User'])->name('dashboard');
Route::get('/customer/order/invoice/{id}', [HomeController::class, 'orderinvoice'])->middleware('auth')->name('order.invoice');




// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });




// frontend controller start 

Route::get('/', [HomeController::class, 'index'])->name('frontend_site');
Route::get('quick/view/modal{id}', [HomeController::class, 'quickviewModal'])->name('quick.view.modal');
// search route start 
Route::get('/product/search', [HomeController::class, 'productSearch'])->name('product.search');
// search route end 
Route::get('/single/product/{id}', [HomeController::class, 'singleProduct'])->name('single.product');
Route::get('/show/category/product/{id}', [HomeController::class, 'categoryProduct'])->name('show.category.product');
Route::get('/show/subcategory/product/{id}', [HomeController::class, 'subcategoryProduct'])->name('show.subcategory.product');
Route::get('/show/brand/product/{id}', [HomeController::class, 'brandProduct'])->name('show.brand.product');
Route::get('/show/all/product', [HomeController::class, 'allProduct'])->name('show.all.product');
// offer duration set
Route::get('/offer/content/duration', [HomeController::class, 'durationset'])->name('offer.content.duration');



// shoping cart part
Route::post('/product/add-to-cart', [ShoppingCart::class, 'addToCart'])->name('product.add_to_cart');
Route::get('/product/cart-view-list', [ShoppingCart::class, 'cartViewList'])->name('product.cart.view');
Route::get('/product/add-to-cart-delete/{id}', [ShoppingCart::class, 'addToCartDelete'])->name('product.add_to_cart-delete');
// social login route 

Route::get('/socialite/create', [SocialController::class, 'create'])->name('socialite.create');
Route::get('/sociallogin/store', [SocialController::class, 'login'])->name('socialite.login');
Route::post('/sociallogin/setpass/{sid}', [SocialController::class, 'setpass'])->name('socialite.setpass');
// product checkout part 

Route::middleware('auth')->group(function () {

    Route::get('/product/checkout', [CheckoutController::class, 'index'])->name('product.checkout');
    Route::get('/select/shipping/charge', [CheckoutController::class, 'selectshippingcharge']);
    Route::post('/product/shipping/details', [CheckoutController::class, 'shippingDetails'])->name('product.shipping.details');
    Route::get('/product/payment', [CheckoutController::class, 'payment'])->name('product.payment');
    Route::post('/product/place_order', [CheckoutController::class, 'placeOrder'])->name('product.placeOrder');
    Route::get('/user/logout', [CustomerDashboardController::class, 'logout'])->name('user.logout');

    // cart wishlist route
    Route::post('/product/add-to-wishlist', [ShoppingWishlist::class, 'addToWishlist'])->name('product.add_to_wishlist');
    Route::get('/product/wishlist/view', [ShoppingWishlist::class, 'viewWishlist'])->name('product.wishlist.view');
    Route::get('/product/add-to-wishlist-delete/{id}', [ShoppingWishlist::class, 'addToWishlistDelete'])->name('product.add_to_wishlist-delete');
    
    // Product Review and rating route
    Route::post('product/review', [ReviewController::class, 'storeReview'])->name('product.review.store');
    Route::get('/product/review-delete/{id}', [ReviewController::class, 'deleteReview'])->name('product.review.delete');
    
});
// review show 
Route::get('product/review/show{id}', [ReviewController::class, 'showReview'])->name('product.review.show');

// product filter route
Route::get('product/price/filter', [ProductFilterController::class, 'productPriceFilter'])->name('product.price.filter');
Route::get('product/price/short/by/high', [ProductFilterController::class, 'productPriceSortByHigh'])->name('product.price.sortby.high');
Route::get('product/price/short/by/low', [ProductFilterController::class, 'productPriceSortByLow'])->name('product.price.sortby.low');







// ***************end frontend route **************








require __DIR__.'/auth.php';


?>