<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcacionTaxiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query=DB::select("SELECT m.id,c.id as colaborador_id ,m.codigo,c.nombre,m.estado,m.entrada,c.tipo FROM marcacion m
                          INNER JOIN colaborador c on c.codigo=m.codigo
                          WHERE m.entrada BETWEEN (SELECT inicio FROM horario) and (SELECT fin FROM horario)
                          AND m.estado='entrada' AND c.tipo='taxi' " ); 

        return response()->json(['data'=>$query]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
