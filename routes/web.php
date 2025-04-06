<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\UserController;
use App\Services\SuggestionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/users', [UserController::class, 'all'])->name('users');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/log/add', [LogController::class, 'index'])->name('log.add');
Route::post('/log/store', [LogController::class, 'store'])->name('log.store');
Route::get('/log/show/{id}', [LogController::class, 'show'])->name('log.show');
Route::get('/log/edit/{id}', [LogController::class, 'edit'])->name('log.edit');
Route::put('/log/update/{id}', [LogController::class, 'update'])->name('log.update');
Route::delete('/log/destroy/{id}', [LogController::class, 'destroy'])->name('log.destroy');
Route::get('/search', [LogController::class, 'search'])->name('log.search');
Route::post('/api/diagnosis', [SuggestionController::class, 'diagnosis'])->name('api.diagnosis');
Route::post('/api/country', [SuggestionController::class, 'country'])->name('api.country');
Route::post('/api/address', [SuggestionController::class, 'address'])->name('api.address');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
