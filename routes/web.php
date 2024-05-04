<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ReservationsController;
use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\FeesController;
use App\Http\Controllers\Admin\AdminsController;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

// for Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/homepage', [HomeController::class, 'homePage'])->name('homepage');

// for Login & Registration
Route::get('/test/login-admin', [LoginController::class, 'adminLogin'])->name('login-admin');
Route::get('/login', [LoginController::class, 'userLogin'])->name('login');
Route::get('/test/registration', [RegisterController::class, 'showRegistrationFormTest']);

// for Profile
Route::get('/profile/show', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

// for Reservation
Route::get('/reservation/list', [ReservationController::class, 'showAllConfirmationReservation'])->name('reservation.list');
Route::get('/reservation/confirmation', [ReservationController::class, 'showConfirmationReservation'])->name('reservation.confirmation');
Route::get('/reservation/completion', [ReservationController::class, 'showCompletionReservation'])->name('reservation.completion');

//For Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
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
    Route::get('/fees/edit',[FeesController::class,'updateRegisteredFees'])->name('fees.edit');

    //For Areas
    Route::get('/areas/show', [AreasController::class, 'showAreas'])->name('areas.show');
    Route::get('/areas/edit',[AreasController::class,'editRegisteredAreas'])->name('areas.edit');

    //For Reservations
    Route::get('/reservations/show', [ReservationsController::class, 'showReservations'])->name('reservations.show');
});
