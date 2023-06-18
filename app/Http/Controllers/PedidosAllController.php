<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosAllController extends Controller
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

        return new PedidoCollection(Pedido::with('user')->with('productos')
                                            ->where('estado',0)
                                            ->whereBetween('created_at',[$inicio,$fin])
                                            ->orderby('created_at','desc')
                                            ->get());
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
}
