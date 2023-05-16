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
      
        $producto = new Producto;

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->categoria_id = $request->categoria_id;
        $producto->tipo = $request->tipo;

        // $file = $request->imagen;
        // $filename = $file->getClientOriginalName();
        // $filename = pathinfo($filename,PATHINFO_FILENAME);
        // $name_file = str_replace(" ","_",$filename);
        // $extension = $file->getClientOriginalExtension();
        // $picture = $name_file.'.'.$extension;
        // $file->move('C:\xampp\htdocs\react-bar\public\img',$picture);

        $producto->imagen = $request->imagen->store('');   
              
        $producto->save();
        

        return[
            
            'producto'=>$producto,
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
