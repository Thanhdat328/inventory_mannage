<?php

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\ReceiverController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\OrderIssueController;







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

//CRUD receiver
Route::get('receiver',[ReceiverController::class, 'index'])->name('receiver.index');
Route::get('receiver/create',[ReceiverController::class, 'create'])->name('receiver.create');
Route::post('receiver/store',[ReceiverController::class, 'store'])->name('receiver.store');
Route::get('receiver/edit/{id}',[ReceiverController::class, 'edit'])->name('receiver.edit');
Route::put('receiver/update/{id}',[ReceiverController::class, 'update'])->name('receiver.update');
Route::delete('receiver/{id}',[ReceiverController::class, 'delete'])->name('receiver.delete');
Route::get('receiver/view/{id}',[ReceiverController::class, 'view'])->name('receiver.view');

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

});

//Report
Route::get('report', [ReportController::class, 'index'])->name('report.index');
Route::get('report/date', [ReportController::class, 'date_wise'])->name('report.date');
Route::post('report/date', [ReportController::class, 'generate_date_wise_report'])->name('report.generate_date');
Route::get('report/month', [ReportController::class, 'month_wise'])->name('report.month');
Route::post('report/month', [ReportController::class, 'generate_month_wise_report'])->name('report.generate_month');

