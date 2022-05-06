<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\PromocaoController;
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
    Route::get('/list/public', [FilialController::class, 'listPublic']);
    Route::get('/list/public/cupons', [PromocaoController::class, 'showPublic']);
    Route::get('/cupom/pegar', [PromocaoController::class, 'pegar']);
    Route::get('/user/cupons', [PromocaoController::class, 'userCupons']);
    Route::get('/create/empresa', [EmpresaController::class, 'createEmpresa']);
    Route::get('/create/filial', [FilialController::class, 'createFilial']);
});
Route::get('auth/google', [AuthController::class, 'googleLoginUrl']);
Route::get('auth/google/callback', [AuthController::class, 'loginCallback']);
