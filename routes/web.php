<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('test/registration', [RegisterController::class, 'showRegistrationFormTest']);