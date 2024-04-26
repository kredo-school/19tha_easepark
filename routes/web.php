<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/homepage', function () {
    return view('users.home.index');
})->name('homepage');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/test/login-admin', [LoginController::class, 'adminLogin'])->name('login-admin');
    // Route::get('/login', [LoginController::class, 'userLogin'])->name('login');
    Route::get('/profile/show', [ProfileController::class, 'showProfile'])->name('profile.show');
    // Route::get('/homepage', [HomeController::class, 'homePage'])->name('homepage');
    Route::get('/test/login-admin', [LoginController::class, 'adminLogin'])->name('login-admin');
    Route::get('/reservation/list', [ReservationController::class, 'showAllConfirmationReservation'])->name('reservation.list');
    Route::get('/reservation/confirmation', [ReservationController::class, 'showConfirmationReservation'])->name('reservation.confirmation');
    Route::get('/reservation/completion', [ReservationController::class, 'showCompletionReservation'])->name('reservation.completion');

});

// Admin registration routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        // Existing login routes
        Route::get('login', [AdminLoginController::class, 'adminLogin'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');

        // Add registration routes
        Route::get('register', [AdminRegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [AdminRegisterController::class, 'register'])->name('register.submit');
    });

    Route::middleware('auth:admin')->group(function () {
        // Existing logout route
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
        
        // Other admin routes
        Route::get('/users/show', [UsersController::class, 'showUsers'])->name('users.show');
        
    });
});



