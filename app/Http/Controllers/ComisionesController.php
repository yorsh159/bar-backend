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

        $comision->user_id = Auth::user()->id;
        $comision->colaborador_id = $request->colaborador;
        $comision->comision = $request->comision;
        $comision->total = $request->totalBoleta;
        $comision->save();

        $id = $comision->id;

        $notas = $request->notas;

        $nota_detalle = [];
        
        foreach($notas as $nota){
            $nota_detalle[]=[
                'comisiones_id'=>$id,
                'pedido_id'=>$nota['id'],
                'mesa'=>$nota['mesa'],
                'created_at'=> now(),
                'updated_at'=> now(),
            ];
        }
        ComisionNotaDetalle::insert($nota_detalle);

        $pedidos = $request->pedidos;      
        
        $pedido_detalle = [];

        foreach($pedidos['pedido'] as $pedido){  
            $pedido_detalle[]=[
                'comisiones_id'=>$id,
                'pedido_id'=>$pedido['nota'],
                'cantidad'=>$pedido['cantidad'],
                'producto_id'=>$pedido['id'],
                'created_at'=> now(),
                'updated_at'=> now(),
            ];
        }

        ComisionPedidoDetalle::insert($pedido_detalle);

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
