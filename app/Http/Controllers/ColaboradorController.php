<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColaboradorRequest;
use App\Http\Resources\ColaboradorCollection;
use App\Models\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ColaboradorCollection(Colaborador::where('estado','1')->orderBy('nombre','asc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColaboradorRequest $request)
    {
        $data = $request->validated();

        $colaborador = Colaborador::create([
            'codigo' => $data['codigo'],
            'nombre' => $data['nombre'],
            'tipo' => $data['tipo'],
            'email' => $data['email']
        ]);

        return[
            
            'colaborador'=>$colaborador,
        ];
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
    public function update(Request $request, Colaborador $colaborador)
    {
        $colaborador->nombre = $request->nombre;
        $colaborador->email = $request->email;
        $colaborador->tipo = $request->tipo;
        $colaborador->save();
        
        return [
           'colaborador'=> $colaborador,
        ];
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Colaborador $colaborador)
    {
        //Eliminar colaborador
        $colaborador->estado = 0;
        $colaborador->save();

        return[
            'colaborador'=>$colaborador,
        ];
    }
}
