<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;

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

Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//menu
Route::prefix('categores')->group(function(){

    Route::get('/', [CategoriesController::class,'index'])->name('category');
    Route::get('edit/{category}', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::post('edit/{category}', [CategoriesController::class, 'update'])->name('category.update');
    Route::get('add', [CategoriesController::class, 'create']);

    Route::post('store', [CategoriesController::class, 'store'])->name('category.store');
    Route::delete('destroy/{category}', [CategoriesController::class, 'destroy'])->name('category.destroy');
    Route::get('show/{category}', [CategoriesController::class, 'show'])->name('category.show');

});


  #Product
  Route::prefix('products')->group(function () {

    Route::get('/', [ProductController::class, 'index'])->name('product');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('add', [ProductController::class, 'create'])->name('product.create');
    Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('edit/{product}', [ProductController::class, 'update'])->name('product.update');
    

});

