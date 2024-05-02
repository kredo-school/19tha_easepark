<?php

use App\Http\Controllers\admin\AreasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\FeesController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\admin\AdminsController;
use App\Http\Controllers\admin\AttributesController;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/test/login-admin', [LoginController::class, 'adminLogin'])->name('login-admin');
Route::get('/login', [LoginController::class, 'userLogin'])->name('login');

Route::get('/profile/show', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
Route::get('/homepage', [HomeController::class, 'homePage'])->name('homepage');
Route::get('/test/login-admin', [LoginController::class, 'adminLogin'])->name('login-admin');
Route::get('/reservation/list', [ReservationController::class, 'showAllConfirmationReservation'])->name('reservation.list');
Route::get('/reservation/confirmation', [ReservationController::class, 'showConfirmationReservation'])->name('reservation.confirmation');
Route::get('/reservation/completion', [ReservationController::class, 'showCompletionReservation'])->name('reservation.completion');

//Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/attribute/edit', [AttributesController::class, 'editAttribute'])->name('attributes.edit');
    Route::get('/admins/edit', [AdminsController::class, 'editAdmin'])->name('edit');
    Route::get('/admins/register', [AdminsController::class, 'registerAdmin'])->name('register');
    Route::get('/users/show', [UsersController::class, 'showUsers'])->name('users.show');
    Route::get('/fees/show', [FeesController::class, 'showFees'])->name('fees.show');
    Route::get('/fees/edit',[FeesController::class,'updateRegisteredFees'])->name('fees.edit');
    Route::get('/areas/edit',[AreasController::class,'editRegisteredAreas'])->name('edit');
    
    // Following routes are test routes for the StatisticsController
    Route::get('/statistics/show/test', [StatisticsController::class, 'showStatisticsTest']);
    Route::get('/statistics/test/registrations-num/data', [StatisticsController::class, 'fetchRegistrationDataTest']);
    Route::get('/statistics/test/deletions-num/data', [StatisticsController::class, 'fetchDeletionDataTest']);
    Route::get('/statistics/test/reservations-num/data', [StatisticsController::class, 'fetchReservationDataTest']);
    Route::get('/statistics/test/cancellations-num/data', [StatisticsController::class, 'fetchCancellationDataTest']);
    Route::get('/statistics/test/sales-num/data', [StatisticsController::class, 'fetchSaleDataTest']);
    // End of test routes for the StatisticsController
});
