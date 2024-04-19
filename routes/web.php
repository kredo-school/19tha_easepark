<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/profile/show', [ProfileController::class, 'showProfile'])->name('profile.show');
Route::get('/homepage', [HomeController::class, 'homePage'])->name('homepage');

