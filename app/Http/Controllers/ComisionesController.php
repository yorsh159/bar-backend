<?php

namespace App\Http\Controllers;

use App\Models\Comisiones;
use App\Models\ComisionNotaDetalle;
use App\Models\ComisionPedidoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComisionesController extends Controller
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
        

        $user = Auth::user()->id;

        $comision_total = $request->comisionBoleta;
        $comision_unitaria = $request->comisionUnitaria;
 
        $colaboradores = $request->colaborador;

        $boleta_id = $request->nota;
        //$id=json_decode($boleta_id);
        //$id2=implode($id);
        foreach($boleta_id as $boleta_id){
            $id=$boleta_id['id'];
        }


        $colaboradorArr = [];

        foreach($colaboradores as $colaborador){
            $colaboradorArr[]=[
                'user_id'=>$user,
                'colaborador_id'=>$colaborador['id'],
                'comision_total'=>$comision_total,
                'comision_unitaria'=>$comision_unitaria,
                'ticket_id'=> $id,
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }
        
        Comisiones::insert($colaboradorArr);


        $now=now();
        $boletas=$request->nota;
        

        foreach($boletas as $boleta){
            $boleta_id = $boleta['id'];
            DB::update("UPDATE boletas set is_comision = 1, updated_at = '$now'  WHERE id = $boleta_id");         
        }

        //foreach($boletas as $boleta){
        //    
        //    $boleta_id = $boleta['id'];
        //    DB::update("UPDATE comisiones set ticket_id = $boleta_id, updated_at = '$now'  WHERE id = $id");         
        //}

    }

    /**
     * Display the specified resource.
     */
    public function show(Comisiones $comisiones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comisiones $comisiones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comisiones $comisiones)
    {
        //
    }
}
