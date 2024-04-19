<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/homepage', [HomeController::class, 'homePage'])->name('homepage');
Route::get('/reservation/list', [ReservationController::class, 'showAllConfirmationReservation'])->name('reservation.list');