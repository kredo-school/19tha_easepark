<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/reservation/confirmation', [App\Http\Controllers\ReservationController::class, 'showConfirmationReservation'])->name('reservation.confirmation');
