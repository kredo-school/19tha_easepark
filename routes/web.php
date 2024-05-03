<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\AdminsController;
// use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\FeesController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/homepage', function () {
    return view('users.home.index');
})->name('homepage');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route::get('/test/login-admin', [LoginController::class, 'adminLogin'])->name('login-admin');

    // for Profile
    Route::get('/profile/show', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    // for Reservation
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
        // For Users
        Route::get('/users/show', [UsersController::class, 'showUsers'])->name('users.show');

        // For Attributes
        Route::get('/attribute/show', [AttributesController::class, 'showAttribute'])->name('attributes.show');
        Route::get('/attribute/edit', [AttributesController::class, 'editAttribute'])->name('attributes.edit');

        //For Admins
        Route::get('/admins/register', [AdminsController::class, 'registerAdmin'])->name('admins.register');
        Route::get('/admins/edit', [AdminsController::class, 'editAdmin'])->name('admins.edit');
        Route::get('/admins/show', [AdminsController::class, 'showAdmins'])->name('admins.show');

        //For Fees
        Route::get('/fees/show', [FeesController::class, 'showFees'])->name('fees.show');
        Route::get('/fees/edit', [FeesController::class, 'updateRegisteredFees'])->name('fees.edit');

        //For Areas
        Route::get('/areas/show', [AreasController::class, 'showAreas'])->name('areas.show');
        Route::get('/areas/edit', [AreasController::class, 'editRegisteredAreas'])->name('areas.edit');
    });
});



