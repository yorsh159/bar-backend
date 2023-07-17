<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoCollection;
use App\Models\Horario;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$horario = Horario::where('id',1)->get();


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
        //Almacenar pedido
        $pedido = new Pedido;
        $pedido->user_id = Auth::user()->id;
        $pedido->mesa = $request->mesa;
        $pedido->total = $request->total;
        $pedido->save();

        //Obtener el ID del pedido
        $id = $pedido->id;
        //Obtener los productos
        $productos = $request->productos;
        //Formatear un arreglo
        $pedido_producto = [];
        
        foreach($productos as $producto){
            $pedido_producto[] = [
                'pedido_id' => $id,
                'producto_id'=> $producto['id'],
                'cantidad'=>$producto['cantidad'],
                'created_at'=> now(),
                'updated_at'=> now(),
            ];
        }
        
        //Almacenar en la BD
        PedidoDetalle::insert($pedido_producto);


        return [
            'message' => 'Pedido Realizado con éxito',
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Pedido $pedido)
    {
        // $pedidos=$request->nota;
        // $pedido_upd = [];
        // foreach($pedidos as $pedido){
        //     DB::update("UPDATE pedidos set ticket_estado = 1  WHERE id = '$pedido->id'");
        // }
        $pedido->estado=1;
        $pedido->save();
        
        
       
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->estado=1;
        $pedido->save();
    }
}
