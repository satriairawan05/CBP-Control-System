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

Route::get('register', [\App\Http\Controllers\Auth\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [\App\Http\Controllers\Auth\AuthController::class, 'register'])->name('register.store');
Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login.store');

Route::get('clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');

    return redirect()->back()->with('success', 'Successfully Clearing!');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', [\App\Http\Controllers\Admin\HomeController::class, 'home'])->name('home');

    // Role
    Route::resource('role', \App\Http\Controllers\Admin\GroupController::class);

    // User
    Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    Route::get('user/{user}/changepassword', [\App\Http\Controllers\Admin\UserController::class, 'changePasswordForm'])->name('user.changepassword');
    Route::put('user/{user}/password', [\App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('user.password');
    Route::get('user/{user}/changeimage', [\App\Http\Controllers\Admin\UserController::class, 'changeImageForm'])->name('user.changeimage');
    Route::put('user/{user}/image', [\App\Http\Controllers\Admin\UserController::class, 'changeImage'])->name('user.image');

    // Approval
    Route::resource('approval',\App\Http\Controllers\Admin\ApprovalController::class);

    // Project
    Route::resource('project', \App\Http\Controllers\Admin\ProjectController::class);
    Route::put('project/{project}/approval',[\App\Http\Controllers\Admin\ProjectController::class, 'updateApproval'])->name('project.updateApproval');

    // Task
    Route::resource('task', \App\Http\Controllers\Admin\TaskController::class);

    // Report
    Route::resource('report', \App\Http\Controllers\Admin\ReportController::class);
    Route::put('report/{report}/approval',[\App\Http\Controllers\Admin\ReportController::class, 'updateApproval'])->name('report.updateApproval');

    // Contract
    Route::resource('contract', \App\Http\Controllers\Admin\ContractController::class);

    // Invoice
    Route::resource('invoice', \App\Http\Controllers\Admin\InvoiceController::class);

    // Logout
    Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
});
