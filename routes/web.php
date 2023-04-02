<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('auth.')->prefix('/auth')->group(function () {
    Route::post('/login',  'App\Http\Controllers\AuthController@login')->name('login');
    Route::post('/register',  'App\Http\Controllers\AuthController@register')->name('register');
    Route::post('/logout',  'App\Http\Controllers\AuthController@logout')->name('logout');
});
Route::name('map.')->prefix('/map')->middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\MapController::class, 'index'])->name('index');
    Route::post('/stations', [App\Http\Controllers\MapController::class, 'stations'])->name('stations');
    Route::get('/models', [App\Http\Controllers\MapController::class, 'models'])->name('models');
});

