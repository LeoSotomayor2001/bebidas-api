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
        try{
            $bebidas = Bebida::select('id', 'nombre', 'tipo', 'imagen')->get();
            return response()->json(['bebidas' => $bebidas], 200);
        }
        catch(Exception $e){
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
        ]);

        return response()->json(['bebida' =>  $bebida]);
    }

    public function update(BebidaRequest $request, string $id)
    {
   

        $bebidaExist = Bebida::find($id);
        if (!$bebidaExist) {
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

        $bebidaExist->update($data);

        return response()->json(['bebida actualizada',$bebidaExist], 200);
    }

    public function show(Bebida $bebida)
    {
        return response()->json(['bebida' => $bebida], 200);
    }

    public function searchBebidas(Request $request) {
        try{
            // Capturar el parámetro 'nombre' de la solicitud GET
            $nombre = $request->input('nombre');
        
            // Realizar la consulta a la base de datos
            $bebidas = Bebida::select('nombre', 'tipo', 'imagen')
                ->where('nombre', 'like', '%' . $nombre . '%')
                ->get();
        
            return response()->json(['bebidas' => $bebidas], 200);

        }
        catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        $imagenPath = public_path() . '/storage/imagenes/' . $bebidaExist->imagen;
        if (file_exists($imagenPath)) {
            unlink($imagenPath);
        }
        Bebida::destroy($id);

        return response()->json(['bebida eliminada'], 200);
    }
}
