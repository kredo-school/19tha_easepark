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


Route::get('/homepage', [HomeController::class, 'showHomePage'])->name('homepage');
Route::get('/homepage/available-dates/{attributeId}', [HomeController::class, 'fetchAttributeAndAvailableDates']);

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    // for Profile
    Route::get('/profile/{id}/show', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::patch('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/password', [ProfileController::class, 'changePassword'])->name('profile.password');
    Route::delete('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');

    // for Reservation
    Route::get('/reservation/list', [ReservationController::class, 'showReservationList'])->name('reservation.list');
    Route::get('/reservation/filter-list', [ReservationController::class, 'filterReservationList']);
    Route::post('/reservation/pass-to-confirmation', [ReservationController::class, 'passToConfirmation']);
    Route::get('/reservation/confirmation', [ReservationController::class, 'showConfirmationReservation'])->name('reservation.confirmation');
    Route::post('/reservation/reserve-spaces', [ReservationController::class, 'reserveSpaces']);
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
        Route::delete('/users/{id}/deactivate',[UsersController::class,'deactivateUsers'])->name('users.deactivate');
        Route::patch('/users/{id}/activate',[UsersController::class,'activateUsers'])->name('users.activate');

        // For Attributes
        Route::get('/attributes/show', [AttributesController::class, 'showAttribute'])->name('attributes.show');
        Route::post('/attributes/store', [AttributesController::class, 'registerAttribute'])->name('attributes.register');
        Route::get('/attributes/{id}/edit', [AttributesController::class, 'showEditAttributePage'])->name('attributes.showEdit');
        Route::patch('/attributes/{id}/update', [AttributesController::class, 'updateAttribute'])->name('attributes.update');
        Route::delete('/attributes/{id}/deactivate', [AttributesController::class, 'deactivateAttributes'])->name('attributes.deactivate');
        Route::patch('/attributes/{id}/activate', [AttributesController::class, 'activateAttributes'])->name('attributes.activate');

        //For Admins
        Route::get('/admins/show', [AdminsController::class, 'showAdmins'])->name('admins.show');
        Route::get('/admins/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('admins.register');
        Route::post('/admins/store', [AdminsController::class, 'registerAdmin'])->name('admins.store');
        Route::get('/admins/{id}/edit', [AdminsController::class, 'showEditAdminPage'])->name('admins.showEdit');
        Route::patch('/admins/update', [AdminsController::class, 'updateAdmin'])->name('admins.update');
        Route::patch('/admins/password', [AdminsController::class, 'changePassword'])->name('admins.password');
        Route::delete('/admins/delete', [AdminsController::class, 'deleteAdmin'])->name('admins.delete');

        //For Fees
        Route::get('/fees/show', [FeesController::class, 'showFees'])->name('fees.show');
        Route::post('/fees/register',[FeesController::class,'registerFee'])->name('fees.register');
        Route::get('/fees/{id}/edit', [FeesController::class, 'showEditFeePage'])->name('fees.showEdit');
        Route::patch('/fees/{id}/update', [FeesController::class, 'updateRegisteredFees'])->name('fees.update');
        Route::delete('/fees/{id}/destroy', [FeesController::class, 'destroyFees'])->name('fees.destroy');

        //For Areas
        Route::get('/areas/show', [AreasController::class, 'showAreas'])->name('areas.show');
        Route::post('/areas/register',[AreasController::class,'registerArea'])->name('areas.register');
        Route::get('/areas/{id}/edit', [AreasController::class, 'showEditAreaPage'])->name('areas.showEdit');
        Route::patch('/areas/{id}/update',[AreasController::class,'updateArea'])->name('areas.update');
        Route::delete('/areas/{id}/deactivate',[AreasController::class,'deactivateArea'])->name('areas.deactivate');
        Route::patch('/areas/{id}/activate',[AreasController::class,'activateArea'])->name('areas.activate');

        //For Reservations
        Route::get('/reservations/show', [ReservationsController::class, 'showReservations'])->name('reservations.show');
        Route::delete('/reservations/{id}/deactivate',[ReservationsController::class,'deactivateReservations'])->name('reservations.deactivate');
        Route::patch('/reservations/{id}/activate',[ReservationsController::class,'activateReservations'])->name('reservations.activate');

        //For Statistics
        Route::get('/statistics/show', [StatisticsController::class, 'showStatistics'])->name('statistics.show');
        Route::get('/statistics/fetch-data', [StatisticsController::class, 'fetchYearlyStatisticalData']);
    });
});
