<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoComisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function buscarCol($id){
        

        $query=DB::select("SELECT c.id,c.colaborador_id,co.codigo,co.nombre,c.comision_unitaria,c.pagado,c.created_at FROM comisiones c
                            INNER JOIN colaborador co on co.id=c.colaborador_id
                            WHERE c.id=$id and c.pagado=0 
                            and c.estado=1");
        
        return response()->json(['data'=>$query]);

    }

    public function updComision($id){

        $now=now();

        DB::update("UPDATE comisiones set pagado = 1, updated_at = '$now'  WHERE id= $id");

        // $id=DB::select("SELECT id FROM colaborador WHERE codigo='$id' ");
        // $array = json_decode(json_encode($id), true);
        // //return $id;

        // $now=now();
        // $idCol=$array;

        // foreach($idCol as $idCol){
        //     $upd = $idCol['id'];
        //     DB::update("UPDATE comisiones set pagado = 1, updated_at = '$now'  WHERE colaborador_id = $upd and created_at BETWEEN (SELECT inicio FROM horario) and (SELECT fin FROM horario)");
                    
        // }

    }
}
