<?php

namespace App\Http\Controllers;

use App\Models\Comisiones;
use App\Models\ComisionNotaDetalle;
use App\Models\ComisionPedidoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $comision = new Comisiones;

        $user = Auth::user()->id;
        $comision_total = $request->comisionBoleta;
        $comision_unitaria = $request->comisionUnitaria;
 
        $colaboradores = $request->colaborador;

        $colaboradorArr = [];

        foreach($colaboradores as $colaborador){
            $colaboradorArr[]=[
                'user_id'=>$user,
                'colaborador_id'=>$colaborador['id'],
                'comision_total'=>$comision_total,
                'comision_unitaria'=>$comision_unitaria,
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }

        Comisiones::insert($colaboradorArr);


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
