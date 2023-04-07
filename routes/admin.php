<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\Admin\Controller::class, 'index'])->name('index');

Route::resource('/cars', App\Http\Controllers\admin\CarController::class, [
    'only' => ['index', 'store', 'update', 'destroy']
]);

Route::post('/cars/export', [App\Http\Controllers\Admin\CarController::class, 'export'])->name('cars.export');
Route::post('/cars/import', [App\Http\Controllers\Admin\CarController::class, 'import'])->name('cars.import');

Route::resource('/stations', App\Http\Controllers\admin\StationController::class, [
    'only' => ['index', 'store', 'update', 'destroy']
]);

Route::post('/stations/export', [App\Http\Controllers\admin\StationController::class, 'export'])->name('stations.export');
Route::post('/stations/import', [App\Http\Controllers\admin\StationController::class, 'import'])->name('stations.import');

