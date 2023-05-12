<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\BoletaPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoletaController extends Controller
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
        $boleta = new Boleta;
        $boleta->user_id = Auth::user()->id;
        $boleta->total = $request->totalBoleta;
        $boleta->dni = $request->dni;
        $boleta->save();

        $id = $boleta->id;
        $pedidos = $request->nota;

        $boleta_pedido = [];
        foreach($pedidos as $pedido){
            $boleta_pedido[]=[
                'boleta_id'=>$id,
                'pedido_id'=>$pedido['id'],
                'mesa'=>$pedido['mesa'],
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        }

        BoletaPedido::insert($boleta_pedido);

        return [
            'message'=>'Guardando boleta'.$boleta->id,
            'pedidos'=> $request->nota
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Boleta $boleta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Boleta $boleta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boleta $boleta)
    {
        //
    }
}
