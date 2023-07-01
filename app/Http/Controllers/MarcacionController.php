<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarcacionRequest;
use App\Models\Colaborador;
use App\Models\Marcacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcacionController extends Controller
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
       
       //return Marcacion::where('estado','entrada')->whereBetween('entrada_salida',[$fechaHoy,$fechaTomorrow])->get();

       $query=DB::select("SELECT m.id,c.id as colaborador_id ,m.codigo,c.nombre,m.estado,m.entrada,c.tipo FROM marcacion m
                          INNER JOIN colaborador c on c.codigo=m.codigo
                          WHERE m.entrada BETWEEN (SELECT inicio FROM horario) and (SELECT fin FROM horario)
                          AND m.estado='entrada' AND c.tipo='compañia' " ); 

        return response()->json(['data'=>$query]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarcacionRequest $request)
    {
        //$request->validated();

        $colaborador = $request->codigo;

        $nombre = Colaborador::where('codigo',$colaborador)->get('nombre');
        $name=$nombre->implode('nombre');


        if(Colaborador::where('codigo','=',$colaborador)->first()){

            if(Marcacion::where('codigo','=',$colaborador)->where('estado','entrada')->first()){

                return[
                    'message'=>'Primero registre su salida',
                ];

            }else{
                $marcacion=[
                    'codigo'=>$request->codigo,
                    'estado'=>$request->estado,
                    'entrada'=>now(),
                ];
    
                Marcacion::insert($marcacion);

                return[
                    'message'=>'Se registró ingreso de '.$name,
                ];
            }     
            
        }else{
            return[
                'message'=>'No existe Colaborador.',
            ];
        }
        
        
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
    public function update(Request $request)
    {
        
        $colaborador = $request->codigo;
        if(Marcacion::where('codigo','=',$colaborador)->where('salida',null)->first()){

            //$marcacion = $request->estado;
            //Marcacion::where('codigo',$colaborador)->where('salida',null)->update(['estado'=>$marcacion,'salida'=>now()]);

            $now=now();

            DB::update("UPDATE marcacion set estado = 'salida' , salida = '$now' WHERE codigo = '$colaborador' AND salida is null");


            return[
                'message'=>'Se registró salida.',
            ];
        }else{
            
            return[
                'message'=>'No marcó entrada.',
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
