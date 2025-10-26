<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/confections', [ConfectionController::class, 'index'])->name('Our Products');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

use App\Http\Controllers\Auth\LogoutController;
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.panel');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');