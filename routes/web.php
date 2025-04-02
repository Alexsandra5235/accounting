<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/log/add', [LogController::class, 'index'])->name('log.add');
Route::post('/log/store', [LogController::class, 'store'])->name('log.store');
Route::get('/log/show/{id}', [LogController::class, 'show'])->name('log.show');
