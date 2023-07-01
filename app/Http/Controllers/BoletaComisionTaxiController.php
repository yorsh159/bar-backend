<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoletaComisionTaxiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = DB::select("SELECT bp.id,bp.boleta_id, b.total as 'total_igv',
                             (
                               SUM(i.monto_taxi*pd.cantidad)
                             
                             )  as 'comision',
                             b.created_at, b.updated_at
                             FROM boleta_pedidos bp
                             inner join boletas b on b.id = bp.boleta_id
                             inner join pedido_detalles pd on pd.pedido_id=bp.pedido_id
                             join incentivo i on i.producto_id = pd.producto_id
                             where b.estado=1 and b.is_comision_taxi=0 and b.created_at 
                             BETWEEN (SELECT inicio FROM horario) and (SELECT fin FROM horario)
                             GROUP BY bp.boleta_id");

        
        return response()->json(['data'=>$query]);
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
