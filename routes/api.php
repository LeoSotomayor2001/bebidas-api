<?php

use App\Http\Controllers\BebidaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/bebidas/search', [BebidaController::class, 'searchBebidas']);
Route::apiResource('/bebidas', BebidaController::class);
