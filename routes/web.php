<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/dashboard', function () {
    return view('userdashboard');
})->middleware(['auth', 'verified'])->name('userdashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';




// Admin Dashboard
Route::prefix('admin')->middleware(['auth', 'verified', 'isAdmin'])->group(function () {

    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

    Route::view('/dashboard', 'dashboard')->name('admindashboard');


    // Category routes
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::view('category',  'admin.category.index')->name('admincategory');
        Route::view('category/create',  'admin.category.create')->name('admincategorycreate');
        Route::get('category/{category}/edit', 'edit')->name('admincategoryedit');
    });

    // Brand routes
    Route::controller(App\Http\Controllers\Admin\BrandController::class)->group(function () {
        Route::get('brand',  'index')->name('adminbrand');
        Route::get('brand/create',  'create')->name('adminbrandcreate');
        Route::get('brand/{brand}/edit', 'edit')->name('adminbrandedit');
    });


    // Product routes
    Route::controller(App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::view('product',  'admin.product.index')->name('adminproduct');
        Route::get('product/create',  'create')->name('adminproductcreate');
        Route::get('product/{product}/edit', 'edit')->name('adminproductedit');
    });

    // Image Library
    Route::view('image-library', 'admin.image-library.index')->name('adminimagelibrary');
});
