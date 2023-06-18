<?php

namespace App\Http\Controllers;

use App\Http\Resources\HorarioCollection;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new HorarioCollection(Horario::where('id',1)->get());
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
        $inicio = $request->inicio;
        $fin = $request->fin;

        DB::update("UPDATE horario set inicio = '$inicio' , fin = '$fin' WHERE id = '1'");

        return[
          'message'=>'Se registró salida.',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
