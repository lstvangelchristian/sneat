<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pages\BlogController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show-register');
    Route::post('/register', 'register')->name('register');
});

Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('show-login');
    Route::post('/login', 'login')->name('login');
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->controller(BlogController::class)->group(function () {
    Route::get('/blog', 'showBlog')->name('show-blog');
    Route::post('/blog', 'createBlog')->name('create-blog');
    Route::get('/blog/update/{id}', 'renderUpdateModal')->name('render-update-modal');
    Route::put('/blog/update/{id}', 'updateBlog')->name('update-blog');
});
