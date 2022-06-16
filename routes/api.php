<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\PromocaoController;
use App\Http\Controllers\CupomController;
use App\Http\Controllers\UserController;
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

    //Mobile
    Route::get('/list/public/cupons', [PromocaoController::class, 'showPublic']);
    Route::get('/list/public', [FilialController::class, 'listPublic']);
    Route::get('/list/categories', [FilialController::class, 'listCategories']);
    Route::get('/cupom/pegar', [PromocaoController::class, 'pegar']);
    Route::get('/user/cupons', [PromocaoController::class, 'userCupons']);


    //Web
    Route::get('/create/filial', [FilialController::class, 'createFilial']);
    Route::get('/cupons/empresa/list', [CupomController::class, 'userCupons']);
    Route::get('/cupons/empresa/check-consumir', [CupomController::class, 'checkCupom']);
    Route::post('/cupons/empresa/consumir', [CupomController::class, 'consumirCupons']);
    Route::resource('/promocoes', PromocaoController::class);
    Route::get('/filiais/user/ativas', [FilialController::class, 'listUserFiliais']);
    Route::get('/filiais/{id}', [FilialController::class, 'show']);
    Route::put('/filiais/{id}', [FilialController::class, 'update']);
    Route::post('/filiais', [FilialController::class, 'create']);
    Route::get('/dashboard', [UserController::class, 'dashboard']);
});


Route::get('auth/google', [AuthController::class, 'googleLoginUrl']);
Route::get('auth/google/callback', [AuthController::class, 'loginCallback']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
