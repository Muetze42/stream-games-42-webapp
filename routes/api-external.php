<?php

use App\Http\Controllers\External\AuthController;
use App\Http\Controllers\External\ContentController;
use App\Http\Controllers\External\UserController;
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

Route::withoutMiddleware('auth:sanctum')->group(function () {
    Route::get('/', function () {
        return [
            'message' => 'It work’s!',
            'authenticated' => auth()->check(),
            'time' => now(),
        ];
    })->name('online-check');

    Route::prefix('connect')->name('connect.')->group(function () {
        Route::post('create', [AuthController::class, 'create'])
            ->name('create');
    });

    Route::resource('resources.contents', ContentController::class);
});

Route::get('user', [UserController::class, 'show'])
    ->name('user.show');
