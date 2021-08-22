<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\GuruController;

Route::get('/', function () {
    return view('dashboard');
});

// rute users
Route::resource('/users', UsersController::class);
Route::get('/cariUser', [UsersController::class, 'search'])->name('cariUser');

// rute transaksi
Route::resource('/transaksi', TransaksiController::class);

// rute guru
Route::resource('/guru', GuruController::class);
