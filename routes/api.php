<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FilialController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
});
Route::get('auth/google', [AuthController::class, 'googleLoginUrl']);
Route::get('auth/google/callback', [AuthController::class, 'loginCallback']);

Route::get('/list/public', [FilialController::class, 'listPublic']);
