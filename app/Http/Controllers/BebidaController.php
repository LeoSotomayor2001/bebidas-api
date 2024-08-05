<?php

namespace App\Http\Controllers;

use App\Http\Requests\BebidaRequest;
use App\Models\Bebida;
use Illuminate\Http\Request;

class BebidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bebidas=Bebida::select('id', 'nombre', 'tipo', 'imagen')->get();
        return response()->json(['bebidas' => $bebidas], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BebidaRequest $request)
    {
        $request->validated();
        
        $bebida = Bebida::create([
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'imagen' => $request->imagen,
        ]);

        return response()->json(['bebida' =>  $bebida], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
