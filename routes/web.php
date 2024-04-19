<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/homepage', [HomeController::class, 'homePage'])->name('homepage');
Route::get('/test/login-admin', [LoginController::class, 'adminLogin'])->name('login-admin');
Route::get('/reservation/list', [ReservationController::class, 'showAllConfirmationReservation'])->name('reservation.list');