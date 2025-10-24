<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfectionController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/confections', [ConfectionController::class, 'index'])->name('Our Products');




