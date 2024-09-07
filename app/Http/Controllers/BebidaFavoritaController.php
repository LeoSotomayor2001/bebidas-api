<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bebida;
use Exception;
use Illuminate\Http\Request;

class BebidaFavoritaController extends Controller
{
    public function index(Request $request){
        try {
            $user = $request->user();
            $bebidas = $user->bebidasFavoritas()->with('user:id,name,email')->get();
            return response()->json(['bebidas' => $bebidas], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
     
    public function addFavorite(Request $request, Bebida $bebida)
    {
        $user = $request->user();
        $user->bebidasFavoritas()->attach($bebida->id);

        return response()->json(['message' => 'Bebida añadida a favoritos'], 200);
    }

    public function removeFavorite(Request $request, Bebida $bebida)
    {
        $user = $request->user();
        $user->bebidasFavoritas()->detach($bebida->id);

        return response()->json(['message' => 'Bebida eliminada de favoritos'], 200);
    }
}
