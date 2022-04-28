<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipoAtoController;
use App\Http\Controllers\VeiculoPublicacaoController;
use App\Http\Controllers\AtoController;
use App\Http\Controllers\InstituicaoBancariaController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\TipoOrgaoController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\VagaController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\ProvimentoController;
use App\Http\Controllers\TipoProvimentoController;

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
Route::post('login', [AuthController::class, 'login']);
Route::get('cep/{cep}', [CepController::class, 'search']);

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
});
