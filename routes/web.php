<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AreasController;
use App\Http\Controllers\Admin\AttributesController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\FeesController;
use App\Http\Controllers\Admin\ReservationsController;
use App\Http\Controllers\Admin\StatisticsController;


Route::get('/homepage', function () {
    return view('users.home.index');
})->name('homepage');
Route::get('/homepage/available-dates', [HomeController::class, 'passAvailableDates']);

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // for Profile
    Route::get('/profile/{id}/show', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    // for Reservation
    Route::get('/reservation/list', [ReservationController::class, 'showAllConfirmationReservation'])->name('reservation.list');
    Route::get('/reservation/confirmation', [ReservationController::class, 'showConfirmationReservation'])->name('reservation.confirmation');
    Route::get('/reservation/completion', [ReservationController::class, 'showCompletionReservation'])->name('reservation.completion');
    Route::get('/reservation/pdf_view', [ReservationController::class, 'pdf'])->name('pdf_view');
    Route::get('/reservation/pdf_download', [PDFController::class, 'pdf_generator_get'])->name('pdf_download');

});

// Admin registration routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Routes accessible to guests (not logged in)
    Route::middleware('guest:admin')->group(function () {
        // Existing login routes
        Route::get('login', [AdminLoginController::class, 'adminLogin'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');

        // Add registration routes
        Route::get('register', [AdminRegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [AdminRegisterController::class, 'register'])->name('register.submit');
    });
    // Routes accessible to authenticated admin users
    Route::middleware('auth:admin')->group(function () {
        // Existing logout route
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

        // Other admin routes
        // For Users
        Route::get('/users/show', [UsersController::class, 'showUsers'])->name('users.show');

        // For Attributes
        Route::get('/attributes/show', [AttributesController::class, 'showAttribute'])->name('attributes.show');
        Route::get('/attributes/search', [AttributesController::class, 'search'])->name('attributes.search');
        Route::post('/attributes/store', [AttributesController::class, 'store'])->name('attributes.store');
        Route::patch('/attributes/{id}/update', [AttributesController::class, 'update'])->name('attributes.update');
        Route::get('/attributes/{id}/edit', [AttributesController::class, 'editAttribute'])->name('attributes.edit');

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

        //For Reservations
        Route::get('/reservations/show', [ReservationsController::class, 'showReservations'])->name('reservations.show');

        // Following routes are test routes for the StatisticsController
        Route::get('/statistics/show/test', [StatisticsController::class, 'showStatisticsTest'])->name('statistics.show.test');
        Route::get('/statistics/test/registrations-num/data', [StatisticsController::class, 'fetchRegistrationDataTest']);
        Route::get('/statistics/test/deletions-num/data', [StatisticsController::class, 'fetchDeletionDataTest']);
        Route::get('/statistics/test/reservations-num/data', [StatisticsController::class, 'fetchReservationDataTest']);
        Route::get('/statistics/test/cancellations-num/data', [StatisticsController::class, 'fetchCancellationDataTest']);
        Route::get('/statistics/test/sales-num/data', [StatisticsController::class, 'fetchSaleDataTest']);
        // End of test routes for the StatisticsController
    });
});
