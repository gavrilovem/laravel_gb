<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use \App\Http\Controllers\AuthorisationController;
use \App\Http\Controllers\ContactController;
use \App\Http\Controllers\Admin\NewsController as AdminNewsController;
use \App\Http\Controllers\Admin\CategoryController as AdminCategoriesController;
use \App\Http\Controllers\Admin\UserController as AdminUserController;
use \App\Http\Controllers\Account\IndexController;

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

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'checkIfAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('/', [AdminUserController::class, 'index'])
            ->name('index');
        Route::resource('user', AdminUserController::class);
        Route::resource('news', AdminNewsController::class);
        Route::resource('category', AdminCategoriesController::class);
    });

    Route::get('account', [IndexController::class, 'index']);
});

Route::group(['prefix' => 'news', 'as' => 'news.'], function() {
    Route::get('/', [NewsController::class, 'index'])
        ->name('index');
    Route::get('.{id}', [NewsController::class, 'show'])
        ->where('id', '\d+')
        ->name('show');
});

Route::group(['prefix' => 'news.categories', 'as' => 'categories.'], function () {
    Route::get('/', [NewsController::class, 'getCategories'])
        ->name('index');
    Route::get('.{id}', [NewsController::class, 'showByCategory'])
        ->where('id', '\d+')
        ->name('show');
});

Route::match(['post', 'get'], 'contact', [ContactController::class, 'index'])
    ->name('contact');
