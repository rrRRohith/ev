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
    Route::post('/logout',  'App\Http\Controllers\AuthController@logout')->name('logout');
});
