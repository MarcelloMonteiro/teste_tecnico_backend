<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']);

Route::get('/cidades', [CidadeController::class, 'index']);

Route::get('/medicos', [MedicoController::class, 'index']);
Route::middleware('auth:api')->post('/medicos', [MedicoController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::get('/pacientes', [PacienteController::class, 'index']);
    Route::post('/pacientes', [PacienteController::class, 'store']);
    Route::put('/pacientes/{paciente}', [PacienteController::class, 'update']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/consultas', [ConsultaController::class, 'index']);
    Route::post('/consultas', [ConsultaController::class, 'store']);
});

