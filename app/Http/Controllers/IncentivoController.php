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
        $start=DB::select("SELECT inicio FROM horario WHERE id=1");
        $end=DB::select("SELECT fin FROM horario WHERE id=1");

        $inicio=json_decode(json_encode($start), true);
        $fin=json_decode(json_encode($end), true);
        
        $query=DB::select("SELECT i.id,i.codigo,p.nombre,i.monto,i.estado FROM incentivo i
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
    public function update(Request $request, string $id)
    {
        //
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
