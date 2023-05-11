<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        //return response()->json(['categorias'=>Categoria::all()]);

        return new CategoriaCollection(Categoria::all());
    }

    public function store(CategoriaRequest $request)
    {
        $data = $request->validated();

        $categoria = Categoria::create([
            
            'nombre' => $data['nombre'],
            'imagen' => $data['imagen']
        ]);

        return[
            
            'categoria'=>$categoria,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $producto)
    {
        //
    }
}
