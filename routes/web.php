<?php

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
    return view('landing');
})->name('landing-page');

Route::get('register',[\App\Http\Controllers\Auth\AuthController::class,'showRegisterForm'])->name('register');
Route::post('register',[\App\Http\Controllers\Auth\AuthController::class,'register'])->name('register.store');
Route::get('login',[\App\Http\Controllers\Auth\AuthController::class,'showLoginForm'])->name('login');
Route::post('login',[\App\Http\Controllers\Auth\AuthController::class,'login'])->name('login.store');

Route::middleware(['auth'])->group(function(){
    Route::get('home', [\App\Http\Controllers\Admin\HomeController::class, 'home'])->name('home');

    Route::post('logout',[ \App\Http\Controllers\Auth\AuthController::class,'logout'])->name('logout');
});
