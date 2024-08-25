<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BebidaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get('/bebidas/search', [BebidaController::class, 'searchBebidas']);
})->middleware('auth:sanctum');


Route::apiResource('/bebidas', BebidaController::class);

//Autenticacion de usuarios
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);