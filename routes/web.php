<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use \App\Http\Controllers\AuthorisationController;
use \App\Http\Controllers\ContactController;
use \App\Http\Controllers\Admin\NewsController as AdminNewsController;
use \App\Http\Controllers\Admin\CategoryController as AdminCategoriesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/', [AdminNewsController::class, 'index'])
        ->name('index');
    Route::get('/', [AdminCategoriesController::class, 'index'])
        ->name('index');
    Route::resource('news', AdminNewsController::class);
    Route::resource('category', AdminCategoriesController::class);
});
//Route::group(['prefix' => 'admin/news', 'as' => 'admin/news/'], function() {
//    Route::get('/', [AdminNewsController::class, 'index'])
//        ->name('index');
//    Route::get('/{id}', [AdminNewsController::class, 'edit'])
//        ->where('id', '\d+')
//        ->name('edit');
//    Route::put('/update', [AdminNewsController::class, 'update'])
//        ->name('update');
//    Route::get('/create', [AdminNewsController::class, 'create'])
//        ->name('create');
//    Route::get('/store', [AdminNewsController::class, 'store'])
//        ->name('store');
//    Route::get('/destruct', [AdminNewsController::class, 'destruct'])
//        ->name('destruct');
//});
//
//Route::group(['prefix' => 'admin.category', 'as' => 'admin.category.'], function () {
//    Route::get('/', [AdminCategoriesController::class, 'index'])
//        ->name('index');
//    Route::get('.{id}', [AdminCategoriesController::class, 'edit'])
//        ->where('id', '\d+')
//        ->name('edit');
//});

//Route::group(['prefix' => 'news.categories', 'as' => 'categories.'], function () {
//    Route::get('/', [NewsController::class, 'getCategories'])
//        ->name('index');
//    Route::get('.{id}', [NewsController::class, 'showByCategory'])
//        ->where('id', '\d+')
//        ->name('show');
//});

Route::group(['prefix' => 'news', 'as' => 'news.'], function() {
    Route::get('/', [NewsController::class, 'index'])
        ->name('index');
    Route::get('.{id}', [NewsController::class, 'show'])
        ->where('id', '\d+')
        ->name('show');
});

Route::match(['post', 'get'], 'contact', [ContactController::class, 'index'])
    ->name('contact');
