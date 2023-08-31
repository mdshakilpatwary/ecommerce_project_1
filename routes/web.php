<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCatController;

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

});


require __DIR__.'/auth.php';
