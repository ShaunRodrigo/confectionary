<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfectionController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/confections', [ConfectionController::class, 'index']);



Route::get('/', [HomeController::class, 'index']);

