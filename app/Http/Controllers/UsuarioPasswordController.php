<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,User $usuario)
    {
  
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
    public function update(Request $request, User $usuario)
    {
        $this->validate($request,[
            'password' => 'required|min:8',
        ],

        );

        $usuario->password = bcrypt($request->password);
        $usuario->save();
        
        return [
            'usuario'=> $usuario,
        ];

        //DB::update("UPDATE comisiones set estado = 0, updated_at = '$now'  WHERE ticket_id = $idBoleta");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
