<?php

use App\Http\Controllers\Api\GitHubWebhookController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post(
    'github-webhook/' . config('services.github.webhook_path') . '/release',
    [GitHubWebhookController::class, 'release']
)->middleware(EnsureGitHubTokenIsValid::class);
