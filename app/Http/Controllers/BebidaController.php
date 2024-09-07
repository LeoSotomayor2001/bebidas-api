<?php

namespace App\Http\Controllers;

use App\Http\Requests\BebidaRequest;
use App\Models\Bebida;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class BebidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $bebidas = Bebida::with('user:id,name,email') // Cargar la relación user y seleccionar campos específicos
                ->select('id', 'nombre', 'tipo', 'imagen', 'user_id')
                ->get();

            return response()->json(['bebidas' => $bebidas], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BebidaRequest $request)
    {
        $request->validated();
        // Manejar la subida de la imagen
        if ($request->hasFile('imagen')) {
            // Guardar la imagen en la carpeta "public/imagenes"
            $imagePath = $request->file('imagen')->store('imagenes', 'public');
            // Obtener el nombre del archivo para guardar en la base de datos
            $imageName = basename($imagePath);
        } else {
            $imageName = 'no image';
        }

        $bebida = Bebida::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'imagen' => $imageName,
            'user_id' => $request->user_id
        ]);

        return response()->json(['bebida' =>  $bebida]);
    }

    public function update(BebidaRequest $request, Bebida $bebida)
    {

        Gate::authorize('update', $bebida);
        if (!$bebida) {
            return response()->json(['message' => 'Bebida no encontrada'], 404);
        }

        $data = $request->only(['nombre', 'tipo']);

        if ($request->hasFile('imagen')) {
            // Guardar la imagen en la carpeta "public/imagenes"
            $imagePath = $request->file('imagen')->store('imagenes', 'public');
            // Obtener el nombre del archivo para guardar en la base de datos
            $imageName = basename($imagePath);
            $data['imagen'] = $imageName;
        }

        $bebida->update($data);

        return response()->json(['bebida actualizada', $bebida], 200);
    }

    public function show(Bebida $bebida)
    {
        return response()->json(['bebida' => $bebida], 200);
    }

    public function searchBebidas(Request $request)
{
    try {
        // Capturar el parámetro 'nombre' de la solicitud GET
        $nombre = $request->input('nombre');

        // Realizar la consulta a la base de datos
        $bebidas = Bebida::with('user:id,name,email') // Cargar la relación user y seleccionar campos específicos
            ->select('id', 'nombre', 'tipo', 'imagen', 'user_id')
            ->where('nombre', 'like', '%' . $nombre . '%')
            ->get();

        return response()->json(['bebidas' => $bebidas], 200);
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Bebida $bebida)
    {
        Gate::authorize('delete', $bebida);

        if (!$bebida) {
            return response()->json(['bebida no encontrada'], 404);
        }
        $path = "imagenes/{$bebida->imagen}"; // Ruta del archivo
        //$imagenPath = public_path() . '/storage/imagenes/' . $bebidaExist->imagen;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            //unlink($imagenPath);
        }
        Bebida::destroy($bebida->id);

        return response()->json(['bebida eliminada'], 200);
    }
}
