<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('/archive', App\Http\Controllers\ArchiveController::class);
    Route::resource('/about', App\Http\Controllers\AboutController::class);
    Route::post('/archive/search', [App\Http\Controllers\ArchiveController::class, 'search'])->name('search');
});

require __DIR__ . '/auth.php';
