<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoCollection;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return new ProductoCollection(Producto::where('estado',1)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        $data = $request->validated();

        // $producto = Producto::create([
        //     'codigo' => $data['codigo'],
        //     'nombre' => $data['nombre'],
        //     'precio' => $data['precio'],
        //     'cantidad' => $data['cantidad'],
        //     'categoria_id' => $data['categoria_id'],
        //     'tipo' => $data['tipo'],
        //     'imagen' => $data['imagen']
        // ]);

        $data = new Producto($request->all());
        $path = $request->image->store('public/productos');
        
        $data->image = $path;
        $data->save();

        return[
            
            'producto'=>$data,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
