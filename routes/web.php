<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RestaurantControllerController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Auth\Events\Verified;

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
    return view('dashboard');
});


require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('home', [Admin\HomeController::class, 'index'])->name('home');
});

//エラー　Symfony\Component\HttpFoundation\Response::setContent(): Argument #1 ($content) must be of type ?string, Illuminate\View\Factory given, called in C:\xampp\htdocs\laravel-nagoyameshi\vendor\laravel\framework\src\Illuminate\Http\Response.php on line 72
//Route::get('/', [UserController::class, 'index']);



Route::resource('categories', CategoryController::class)->middleware(['auth', 'verified']);