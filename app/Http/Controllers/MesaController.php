<?php

namespace App\Http\Controllers;

use App\Http\Requests\MesaRequest;
use App\Http\Resources\MesaCollection;
use App\Models\Mesa;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new MesaCollection(Mesa::where('estado',1)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MesaRequest $request)
    {
        $data = $request->validated();

        $mesa = Mesa::create([
            'nombre' => $data['nombre'],
           
        ]);

        return[
            
            'mesa'=>$mesa,
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
    public function update(Request $request, Mesa $mesa)
    {
        $mesa->nombre = $request->nombre;
        $mesa->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
