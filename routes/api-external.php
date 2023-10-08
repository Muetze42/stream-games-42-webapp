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

Route::get('/', function () {
    return [
        'message' => 'It work’s!',
        'authenticated' => auth()->check(),
        'time' => now(),
    ];
})->name('check-reachability')->withoutMiddleware('auth:sanctum');

Route::prefix('connect')->name('connect.')->group(function () {
    Route::post('create', [AuthController::class, 'create'])
        ->name('create')
        ->withoutMiddleware('auth:sanctum');
});

Route::get('user', [UserController::class, 'show'])
    ->name('get.authorized.user');

Route::resource('resources.contents', ContentController::class);
