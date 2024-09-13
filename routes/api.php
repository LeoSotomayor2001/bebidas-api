<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BebidaController;
use App\Http\Controllers\BebidaFavoritaController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    // Bebidas Favoritas - Rutas específicas primero
    Route::get('bebidas/favoritas-usuario', [BebidaFavoritaController::class, 'getFavorites']);
    
    // Rutas para otras operaciones de bebidas
    Route::get('/bebidas/search', [BebidaController::class, 'searchBebidas']);
    Route::post('/logout',[AuthController::class,'logout']);
    
    // Rutas RESTful generadas para bebidas favoritas y bebidas
    Route::apiResource('/bebidas/favoritas', BebidaFavoritaController::class);
    Route::apiResource('/bebidas', BebidaController::class);
    
    // Bebidas Favoritas - Añadir y eliminar favoritas
    Route::post('bebidas/{bebida}/favorita', [BebidaFavoritaController::class, 'addFavorite']);
    Route::delete('bebidas/{bebida}/favorita', [BebidaFavoritaController::class, 'removeFavorite']);
})->middleware('auth:sanctum');
Route::get('/imagen/{filename}', [ImageController::class, 'show']);

//Autenticacion de usuarios
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

