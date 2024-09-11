<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bebida;
use Exception;
use Illuminate\Http\Request;

class BebidaFavoritaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $bebidas = $user->bebidasFavoritas()->with('user:id,name,email')->get();
            return response()->json(['bebidas' => $bebidas], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addFavorite(Request $request, $bebidaId)
{
    // Buscar la bebida manualmente
    $bebida = Bebida::find($bebidaId);

    // Si no existe, devolver un mensaje de error
    if (!$bebida) {
        return response()->json(['message' => 'Bebida no encontrada'], 404);
    }

    $user = $request->user();

    // Verificar si la bebida ya está en favoritos
    if($user->bebidasFavoritas()->where('bebida_id', $bebida->id)->exists()){
        return response()->json(['message' => 'Esta bebida ya está añadida a favoritas'], 200);
    }

    // Añadir a favoritos
    $user->bebidasFavoritas()->attach($bebida->id);

    return response()->json(['message' => 'Bebida añadida a favoritas'], 200);
}
    public function getFavorites(Request $request)
    {
        $user = $request->user();
        $favorites = $user->bebidasFavoritas()->pluck('bebida_id');

        return response()->json(['favorites' => $favorites], 200);
    }

    public function removeFavorite(Request $request, Bebida $bebida)
    {
        $user = $request->user();
        $user->bebidasFavoritas()->detach($bebida->id);

        return response()->json(['message' => 'Bebida eliminada de favoritas'], 200);
    }
}
