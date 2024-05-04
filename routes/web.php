<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FeesController;
use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\admin\AdminsController;
use App\Http\Controllers\admin\AttributesController;
use App\Http\Controllers\Admin\StatisticsController;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

// for Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');
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
    Route::get('/attribute/show', [AttributesController::class, 'showAttribute'])->name('attributes.show');
    Route::get('/attribute/edit', [AttributesController::class, 'editAttribute'])->name('attributes.edit');
    Route::get('/admins/edit', [AdminsController::class, 'editAdmin'])->name('edit');
    Route::get('/admins/register', [AdminsController::class, 'registerAdmin'])->name('register');
    Route::get('/users/show', [UsersController::class, 'showUsers'])->name('users.show');
    Route::get('/fees/show', [FeesController::class, 'showFees'])->name('fees.show');
    Route::get('/fees/edit',[FeesController::class,'updateRegisteredFees'])->name('fees.edit');

    //For Areas
    Route::get('/areas/show', [AreasController::class, 'showAreas'])->name('areas.show');
    Route::get('/areas/edit',[AreasController::class,'editRegisteredAreas'])->name('areas.edit');
    Route::get('/areas/register',[AreasController::class,'showRegisterArea'])->name('areas.register');
});

Route::get('/test/registration', [RegisterController::class, 'showRegistrationFormTest']);
