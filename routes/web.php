<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/reservation/completion', [App\Http\Controllers\ReservationController::class, 'showCompletionReservation'])->name('reservation.completion');
