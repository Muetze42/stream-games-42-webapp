<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\HandleInertiaRequests;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'redirect'])
        ->name('auth.redirect');
    Route::post('logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
    Route::get('callback', [AuthController::class, 'callback'])
        ->withoutMiddleware(HandleInertiaRequests::class)
        ->name('auth.callback');
});
