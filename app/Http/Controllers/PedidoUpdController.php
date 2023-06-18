<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoUpdController extends Controller
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
        $now=now();
        $pedidos=$request->nota;

        foreach($pedidos as $pedido){
            $pedido_upd = $pedido['id'];
            DB::update("UPDATE pedidos set ticket_estado = 1, updated_at = '$now'  WHERE id = $pedido_upd");
                    
        }

        //DB::update("UPDATE pedidos set ticket_estado = 1  WHERE id = $pedido_upd");
        // return[
        //     'message'=>$pedido_upd
        // ];
        
        
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
