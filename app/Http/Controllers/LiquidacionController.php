<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiquidacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venta_total = DB::select("SELECT SUM(total) as VentaTotal from boletas 
                             WHERE estado = 1
                             and created_at BETWEEN (SELECT inicio FROM horario) and (SELECT fin FROM horario)");


        return response()->json(['data'=>$venta_total]);
        
    }

    public function metodo_pago()
    {
        $query=DB::select("SELECT p.nombre as Metodo, SUM(b.total) as Total from boletas b 
        INNER JOIN pagos p on p.id = b.pago_id
        WHERE b.estado=1
        and b.created_at BETWEEN (SELECT inicio FROM horario) and (SELECT fin FROM horario)
        GROUP BY pago_id");

        return response()->json(['data'=>$query]);
    }

    public function comision_total()
    {
        $query=DB::select("SELECT colaborador_id, SUM(comision_unitaria) FROM comisiones
        WHERE created_at BETWEEN (SELECT inicio FROM horario) and (SELECT fin FROM horario)
        GROUP BY colaborador_id");

        return response()->json(['data'=>$query]);
    }

    public function ventas(){
        $query=DB::select("SELECT pd.id,pd.pedido_id,pd.producto_id,p.tipo,p.nombre,SUM(pd.cantidad) as CantidadVendida,p.precio,(SUM(pd.cantidad) * p.precio ) as monto from pedido_detalles pd 
        inner join productos p on p.id=pd.producto_id
        WHERE pd.created_at BETWEEN (SELECT inicio FROM horario) and (SELECT fin FROM horario)
        GROUP BY pd.producto_id");

        return response()->json(['data'=>$query]);
    }

    public function pedidos_libre()
    {
        $start=DB::select("SELECT inicio FROM horario WHERE id=1");
        $end=DB::select("SELECT fin FROM horario WHERE id=1");

        $inicio=json_decode(json_encode($start), true);
        $fin=json_decode(json_encode($end), true);

        return new PedidoCollection(Pedido::with('user')->with('productos')
                                            ->where('estado',0)
                                            ->where('ticket_estado',0)
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
