<?php

namespace App\Http\Controllers;

use App\Http\Resources\PagoCollection;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PagoCollection(Pago::where('estado',1)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pago = new Pago;

        $pago->nombre = $request->nombre;
        $pago->save();

        return[
            'message'=>'Pago Registrado',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Pago $pago)
    {
        $pago->estado = 0;
        $pago->save();

        return[
            'pago'=>$pago,
        ];
    }
}
