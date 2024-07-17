<?php

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\OrderIssueController;
use App\Http\Controllers\ReturnOrderCotroller;









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


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return redirect('/login');
});


Auth::routes();
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/order/show/{id}', [HomeController::class, 'show'])->name('home.show');
    Route::put('/order/{id}/approve', [HomeController::class, 'approved'])->name('home.approved');
    Route::post('/order/{id}/rejected', [HomeController::class, 'rejected'])->name('home.rejected');

    //menu
    Route::prefix('categores')->group(function(){
        Route::get('/', [CategoriesController::class,'index'])->name('category');
        Route::get('edit/{category}', [CategoriesController::class, 'edit'])->name('category.edit');
        Route::post('edit/{category}', [CategoriesController::class, 'update'])->name('category.update');
        Route::get('add', [CategoriesController::class, 'create'])->name('category.create');
        Route::post('store', [CategoriesController::class, 'store'])->name('category.store');
        Route::delete('destroy/{category}', [CategoriesController::class, 'destroy'])->name('category.destroy');
        Route::get('show/{category}', [CategoriesController::class, 'show'])->name('category.show');
    });

    //CRUD receiver
    Route::prefix('receiver')->group(function(){
        Route::get('/',[ReceiverController::class, 'index'])->name('receiver.index');
        Route::get('/create',[ReceiverController::class, 'create'])->name('receiver.create');
        Route::post('/store',[ReceiverController::class, 'store'])->name('receiver.store');
        Route::get('/edit/{id}',[ReceiverController::class, 'edit'])->name('receiver.edit');
        Route::put('/update/{id}',[ReceiverController::class, 'update'])->name('receiver.update');
        Route::delete('/{id}',[ReceiverController::class, 'delete'])->name('receiver.delete');
        Route::get('/view/{id}',[ReceiverController::class, 'view'])->name('receiver.view');
    });

    //OrderIssue Function
    Route::get('order_issue', [OrderIssueController::class, 'index'])->name('order_issue.index');
    Route::get('order_issue/create', [OrderIssueController::class, 'create'])->name('order_issue.create');
    Route::post('order_issue/create', [OrderIssueController::class, 'addProductToOrder'])->name('order_issue.addProductToOrder');

    #Product
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::post('store', [ProductController::class, 'store'])->name('product.store');
        Route::get('add', [ProductController::class, 'create'])->name('product.create');
        Route::get('edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('edit/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    });

    //Report
    Route::prefix('report')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('report.index');
        Route::get('/date', [ReportController::class, 'date_wise'])->name('report.date');
        Route::post('/date', [ReportController::class, 'generate_date_wise_report'])->name('report.generate_date');
        Route::get('/month', [ReportController::class, 'month_wise'])->name('report.month');
        Route::post('/month', [ReportController::class, 'generate_month_wise_report'])->name('report.generate_month');
        Route::get('/month/return', [ReportController::class, 'return_product_report'])->name('report.return_month');
        Route::post('/month/return', [ReportController::class, 'generate_return_month_wise_report'])->name('report.generate_return_month');
        Route::get('/{id}', [ReportController::class, 'report_details'])->name('report.report_detail');
        Route::get('/{id}/edit', [ReportController::class, 'edit'])->name('report.edit');
        Route::post('/{id}/edit', [ReportController::class, 'update'])->name('report.update');
    });

    //Return order
    Route::prefix('return_order')->group(function () {
        Route::get('/', [ReturnOrderCotroller::class, 'index'])->name('return_order.index');
        Route::get('{id}', [ReturnOrderCotroller::class, 'show'])->name('return_order.show');
        Route::put('{id}/return', [ReturnOrderCotroller::class,'returnOrder'])->name('return_order.main');
        Route::get('{orderId}/{itemId}/editDamage/{id}', [ReturnOrderCotroller::class, 'editDamageView'])->name('return_order.edit_damage');
        Route::put('{orderId}/{productId}/updateDamage', [ReturnOrderCotroller::class, 'updateDamage'])->name('return_order.update_damage');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/add', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/update/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::get('/view/{id}', [AdminController::class, 'view'])->name('admin.view');
    });
});


