<?php

namespace App\Http\Controllers;

use App\Http\Resources\IncentivoCollection;
use App\Models\Incentivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncentivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $query=DB::select("SELECT i.id,i.codigo,i.producto_id,p.nombre,i.monto,i.monto_taxi,i.estado FROM incentivo i
                           INNER JOIN productos p on p.id=i.producto_id
                           WHERE i.estado=1" ); 

        return response()->json(['data'=>$query]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incentivo = new Incentivo;

        $incentivo->codigo = $request->codigo;
        $incentivo->monto = $request->monto;
        $incentivo->monto_taxi = $request->montoTaxi;
        $incentivo->producto_id = $request->producto;
        $incentivo->save();

        return [
            'message' => 'Guardado con éxito',
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
    public function update(Request $request, Incentivo $incentivo)
    {
        $incentivo->codigo = $request->codigo;
        $incentivo->monto = $request->monto;
        $incentivo->monto_taxi = $request->montoTaxi;
        $incentivo->save();

        return [
            'message' => 'Actualizado con éxito',
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incentivo $incentivo)
    {
        $incentivo->estado = 0;
        $incentivo->save();

        return[
            'message'=>'Registro Eliminado!!!'
        ];
    }
}
