<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoletaCollection;
use App\Models\Boleta;
use App\Models\BoletaPedido;
use App\Models\Pedido;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BoletaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BoletaCollection(Boleta::with('user')
                                            ->with('pedidos')
                                            ->orderby('created_at','desc')
                                            ->get());

        // $query = DB::select('SELECT bp.id, bp.boleta_id, bp.pedido_id, pd.producto_id, pr.nombre, pr.precio ,pd.cantidad, p.total, b.total FROM boleta_pedidos bp
        //             inner join boletas b on b.id = bp.boleta_id
        //             inner join pedidos p on p.id = bp.pedido_id
        //             inner join pedido_detalles pd on pd.pedido_id=bp.pedido_id
        //             inner join productos pr on pr.id = pd.producto_id');
        
        // return response()->json(['data'=>$query]);

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
        $boleta->pago_id = $request->pago;
        $boleta->igv = $request->igvBoleta;
        $boleta->subtotal = $request->subTotalBoleta;
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
            'pedidos'=> $request->nota,

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

    public function listar(){

        $tickets = Boleta::with('user')->where('estado',1)->orderBy('created_at','asc')->get();

        //$ticket = Boleta::where('estado',1)->orderBy('nombre','asc')->get();

        return view('boleta',[
            'tickets'=>$tickets
        ]);
    }

    public function detalle($id){

        $ticket = DB::select('SELECT bp.id, bp.boleta_id, bp.pedido_id, pd.producto_id, pr.nombre, pr.precio ,pd.cantidad, p.total as subtotal, b.total as total, b.created_at, b.igv, b.subtotal as gravada, b.dni FROM boleta_pedidos bp
                               inner join boletas b on b.id = bp.boleta_id
                               inner join pedidos p on p.id = bp.pedido_id
                               inner join pedido_detalles pd on pd.pedido_id=bp.pedido_id
                               inner join productos pr on pr.id = pd.producto_id
                               where bp.boleta_id='.$id);

        return view('detalle',['ticket'=>$ticket]);

    }

    public function PDF($id){

        $ticket = DB::select('SELECT bp.id, bp.boleta_id, bp.pedido_id, pd.producto_id, pr.nombre, pr.precio ,pd.cantidad, p.total as subtotal, b.total as total, b.created_at, b.igv, b.subtotal as gravada, b.dni FROM boleta_pedidos bp
                              inner join boletas b on b.id = bp.boleta_id
                              inner join pedidos p on p.id = bp.pedido_id
                              inner join pedido_detalles pd on pd.pedido_id=bp.pedido_id
                              inner join productos pr on pr.id = pd.producto_id
                              where bp.boleta_id='.$id);

        $pdf = PDF::loadView('pdf',['ticket'=>$ticket])->setPaper('A6');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();

        return view('pdf',['ticket'=>$ticket]);
    }

}
