<?php

use App\Http\Controllers\Api\External\AuthController;
use App\Http\Controllers\Api\External\ExchangeController;
use App\Http\Controllers\Api\External\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return [
        'message' => 'It work’s!',
        'authenticated' => auth()->check(),
        'time' => now(),
    ];
})->name('check-reachability')->withoutMiddleware('auth:sanctum');

/**
 * Authentication process routes.
 */
Route::prefix('connect')->name('connect.')->group(function () {
    Route::post('create', [AuthController::class, 'create'])
        ->name('create')
        ->withoutMiddleware('auth:sanctum');
});

/**
 * Stream Games API routes.
 */
Route::apiResource('user', UserController::class)->only('show');
Route::apiResource('settings', ExchangeController::class);
Route::apiResource('scores', ExchangeController::class);
