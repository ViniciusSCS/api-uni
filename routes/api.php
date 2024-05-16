<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/cadastrar', [UserController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('user')->group(function(){
        Route::get('/', [UserController::class, 'me']);
        Route::get('/listar', [UserController::class, 'index']);
        Route::get('/visualizar/{id}', [UserController::class, 'show']);
        Route::put('/atualizar/{id}', [UserController::class, 'update']);
        Route::delete('/deletar/{id}', [UserController::class, 'destroy']);
    });
});
