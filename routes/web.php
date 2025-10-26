<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/confections', [ConfectionController::class, 'index'])->name('Our Products');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

use App\Http\Controllers\Auth\LogoutController;
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.panel');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/logins', [AdminController::class, 'logins'])->name('admin.logins');
});

// Messages listing (only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
});

// Admin-only message management (edit/update/delete)
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->group(function () {
    Route::get('/messages/{message}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');