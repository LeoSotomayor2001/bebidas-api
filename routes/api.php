<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BebidaController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/bebidas/search', [BebidaController::class, 'searchBebidas']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::apiResource('/bebidas', BebidaController::class);
})->middleware('auth:sanctum');
//Autenticacion de usuarios
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/imagen/{filename}', [ImageController::class, 'show']);
