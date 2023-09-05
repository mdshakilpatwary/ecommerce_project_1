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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// frontend controller start 
Route::get('/', [HomeController::class, 'index']);



// backend controller start 
Route::middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
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

});


require __DIR__.'/auth.php';
