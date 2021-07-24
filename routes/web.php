<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('/users', UsersController::class);
