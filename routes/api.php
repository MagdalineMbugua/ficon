<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Http\Request;
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

Route::get('/auth/redirect', [LoginController::class, 'googleRedirect']);
Route::get('/auth/callback', [LoginController::class, 'googleCallback']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('users/{user}/assign-role', UserRoleController::class);
    Route::apiResource('posts', PostController::class);

});
