<?php

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


Route::post('/cadastrar', [UserController::class, 'store']);
Route::get('/listar', [UserController::class, 'index']);
Route::get('/visualizar/{id}', [UserController::class, 'show']);
Route::put('/atualizar/{id}', [UserController::class, 'update']);
Route::delete('/deletar/{id}', [UserController::class, 'destroy']);






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
