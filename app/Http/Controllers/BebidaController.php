<?php

namespace App\Http\Controllers;

use App\Http\Requests\BebidaRequest;
use App\Models\Bebida;
use Exception;
use Illuminate\Http\Request;

class BebidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bebidas = Bebida::select('id', 'nombre', 'tipo', 'imagen')->get();
        return response()->json(['bebidas' => $bebidas], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BebidaRequest $request)
    {
        // Manejar la subida de la imagen
        if ($request->hasFile('imagen')) {
            // Guardar la imagen en la carpeta "public/imagenes"
            $imagePath = $request->file('imagen')->store('imagenes', 'public');
            // Obtener el nombre del archivo para guardar en la base de datos
            $imageName = basename($imagePath);
        } else {
            $imageName = null; 
        }

        $bebida = Bebida::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'imagen' => $imageName,
        ]);

        return response()->json(['bebida' =>  $bebida]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bebida $bebida)
    {
        return response()->json(['bebida' => $bebida], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(BebidaRequest $request, string $id)
    {

        $bebidaExist = Bebida::find($id);
        if (!$bebidaExist) {
            return response()->json(['bebida no encontrada'], 404);
        }


        $bebida = Bebida::where('id', $id)->update([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'imagen' => $request->imagen,
        ]);

        if (!$bebida) {
            return response()->json(['bebida no actualizada'], 500);
        }

        return response()->json(['bebida actualizada'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $bebidaExist = Bebida::find($id);
        if (!$bebidaExist) {
            return response()->json(['bebida no encontrada'], 404);
        }
        Bebida::destroy($id);

        return response()->json(['bebida eliminada'], 200);
    }
}
