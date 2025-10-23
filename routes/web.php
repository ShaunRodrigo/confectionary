<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfectionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/confections', [ConfectionController::class, 'index']);
