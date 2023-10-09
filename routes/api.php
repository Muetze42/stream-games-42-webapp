<?php

use App\Http\Controllers\Api\GitHubWebhookAbstractController;
use App\Http\Controllers\Api\ReleaseAbstractController;
use Illuminate\Support\Facades\Route;
use NormanHuth\HelpersLaravel\App\Http\Middleware\EnsureGitHubTokenIsValid;

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
})->name('check-reachability');
Route::post('/releases', [ReleaseAbstractController::class, 'index'])
    ->name('release.index');
Route::post(
    'github-webhook/' . config('services.github.webhook_path') . '/release',
    [GitHubWebhookAbstractController::class, 'release']
)->middleware(EnsureGitHubTokenIsValid::class)->name('git-hub-webhook.release');
